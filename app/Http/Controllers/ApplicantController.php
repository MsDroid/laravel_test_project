<?php

namespace App\Http\Controllers;

use App\Models\{Applicant, Payment, Document,Experience, Acknowledgement};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationAcknowledgement;
use App\Http\Requests\{PaymentRequest, PersonalInfoRequest, EducationRequest, ExperienceRequest, DocumentUploadRequest};

class ApplicantController extends Controller
{
    private const REQUIRED_DOCS = ['photo','signature','dob_proof','10th','12th','Graduate'];

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $applicant = $user->applicant;

        
        return view('applicants.dashboard', compact('user', 'applicant'));
    }

    /** Step 1: Payment */
    public function savePayment(PaymentRequest $request)
    {
        $applicant = $request->user()->applicant;

        if ($applicant->already_applied) {
            return back()->withErrors(['already_applied' => 'You have already applied. Payment not required.']);
        }

        $data = $request->validated();
        $path = $data['receipt_path']->store('receipts', 'public');

        Payment::updateOrCreate(
            ['applicant_id' => $applicant->id],
            [
                'bank_name'   => $data['bank_name'],
                'amount'      => $data['amount'],
                'payment_ref' => $data['payment_ref'],
                'payment_date'      => $data['payment_date'],
                'receipt_path'=> $path,
            ]
        );

        return redirect()->route('applicant.dashboard')->with('success', 'Payment saved');
    }

    /** Step 2: Personal info */
    public function savePersonal(PersonalInfoRequest $request)
    {
        $data = $request->validated();

    // Handle file upload
    if ($request->hasFile('photo_id_image')) {
        $fileName = time().'_'.$request->file('photo_id_image')->getClientOriginalName();
        $filePath = $request->file('photo_id_image')->storeAs('uploads/photo_ids', $fileName, 'public');
        $data['photo_id_image'] = $filePath;
    }

    // Update applicant
    $request->user()->applicant->update($data);

    // return back()->with('success','Personal info saved');
    return redirect()->back()->with([
        'success' => 'Profile updated successfully!',
        'profileUpdated' => true
    ]);
    }

    /** Step 2: Education */
    public function saveEducation(EducationRequest $request)
    {
        $applicant = $request->user()->applicant;

        $applicant->educations()->delete();

        foreach ($request->input('educations') as $ed) {
            $percent  = (500 > 0) ? ($ed['marks_obtained'] / 500) * 100 : null;
            $division = $percent ? $this->determineDivision($percent) : null;

            $applicant->educations()->create(array_merge($ed, ['division' => $division,'marks_total' => 500]));
        }

        // $request->user()->applicant->update(["current_step" => $applicant->current_step+1]);

        return back()->with('success','Education saved');
    }

    /** step 2: Experience **/
    public function saveExperience(ExperienceRequest $request)
    {
        $applicant = $request->user()->applicant;

        foreach ($request->experiences as $expData) {
            Experience::create([
                'applicant_id'   => $applicant->id,
                'institution'    => $expData['institution'] ?? null,
                'designation'    => $expData['designation'] ?? null,
                'from_date'      => $expData['from'] ?? null,
                'to_date'        => $expData['to'] ?? null,
                'total_period'   => $expData['total_period'] ?? null,
                'subjects_taught'=> $expData['subjects_taught'] ?? null,
                'current'        => ($expData['status'] === 'current') ? 1 : 0,
            ]);
        }

        
        $applicant->update(['current_step' => $applicant->current_step + 1]);

        return back()->with('success', 'Experience details saved successfully.');
    }

    protected function determineDivision($percent): string
    {
        return match (true) {
            $percent >= 60 => 'First',
            $percent >= 50 => 'Second',
            default        => 'Third',
        };
    }

    /** Step 3: Document Upload */
    public function uploadDocuments(DocumentUploadRequest $request)
    {
        
        $applicant = $request->user()->applicant;

        foreach ($request->documents as $index => $docData) {
            if (!isset($docData['file'])) {
                continue;
            }

            $file = $docData['file']; 
            $type = $docData['type']; 

            $path = $file->store("documents/{$applicant->id}", 'public');

            Document::updateOrCreate(
                ['applicant_id' => $applicant->id, 'type' => $type],
                ['path' => $path]
            );
        }

         $applicant->update(['current_step' => $applicant->current_step + 1]);


        return back()->with('success','Documents uploaded');
    }

    /** Step 4: Final Submission */
    public function submitApplication(Request $request)
    {
        $applicant = $request->user()->applicant;

        if (!$this->hasValidPayment($applicant)) {
            return back()->withErrors(['payment' => 'Payment missing']);
        }

        if ($applicant->bed_required && !$this->hasBedEducation($applicant)) {
            return back()->withErrors(['bed' => 'B.Ed is mandatory for selected subject']);
        }

        // if (!$this->hasAllRequiredDocs($applicant)) {
        //     return back()->withErrors(['documents' => 'Some required documents are missing']);
        // }
        

        $applicant->update([
            'submitted'    => true,
            'submitted_at' => Carbon::now(),
            'status'       => 'pending',
        ]);

         $pdfDir = storage_path('app/public/acknowledgements');
        if (!file_exists($pdfDir)) {
            mkdir($pdfDir, 0777, true);
        }
       
        $ack = Acknowledgement::create([
            'applicant_id' => $applicant->id,
            'ack_no'       => $this->generateAckNo(),
            
        ]);

         $pdf = Pdf::loadView('pdf.acknowledgement', compact('applicant', 'ack'));
        $pdfPath = $pdfDir . "/ack_{$ack->ack_no}.pdf";
        $pdf->save($pdfPath);

        $ack->update([
            'pdf_path' => "acknowledgements/ack_{$ack->ack_no}.pdf",
        ]);
       

        Mail::to($request->user()->email)->send(new ApplicationAcknowledgement($applicant, $ack, $pdfPath));

        return redirect()->route('applicant.dashboard', $applicant->id)->with('success','Application submitted successfully. Acknowledgement slip sent to your email.');
    }

    protected function hasValidPayment($applicant): bool
    {
        return $applicant->already_applied || $applicant->payments()->exists();
    }

    protected function hasBedEducation($applicant): bool
    {
        return $applicant->educations()->where('level', 'B.Ed')->exists();
    }

    protected function hasAllRequiredDocs($applicant): bool
    {
        foreach (self::REQUIRED_DOCS as $doc) {
            if (!$applicant->documents()->where('type', $doc)->exists()) {
                return false;
            }
        }
        return true;
    }

    protected function generateAckNo(): string
    {
        return strtoupper('ACK' . time() . Str::random(3));
    }

    /** Preview */
    public function preview($id)
    {
        $applicant = Applicant::with(['payments','educations','experiences','documents','acknowledgement'])
            ->findOrFail($id);

        return view('applicants.preview', compact('applicant'));
    }
}
