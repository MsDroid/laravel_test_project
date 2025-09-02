<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Storage;
use App\Models\Applicant;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pending = Applicant::where('status', 'pending')->count();
        $approved = Applicant::where('status', 'approved')->count();
        $rejected = Applicant::where('status', 'rejected')->count();

        return view('admin.dashboard', compact('pending', 'approved', 'rejected'));
    }

    public function pendingForms()
    {
        $applicants = Applicant::where('status', 'pending')->get();
        return view('admin.pending', compact('applicants'));
    }

    public function viewApplicant($id)
    {
        $applicant = Applicant::with(['educations', 'experiences', 'documents'])->findOrFail($id);
        return view('admin.view_applicant', compact('applicant'));
    }

    public function approveApplicant(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        // Generate Registration No. -> e.g. CED/TENG/2024/6589652 (6 digit random number 6589652)
        $subjectCodes = self::subjectCodes(); // ENG, MAT, HIN, AGR
         $year = now()->year;
          $randomNo = random_int(1000000, 9999999);
        $subjectCode = $subjectCodes[$applicant->subject] ?? 'TGEN';
        $regNo = "CED/{$subjectCode}/{$year}/{$randomNo}";

        // Generate PDF
        // $pdf = PDF::loadView('pdf.registration', compact('applicant', 'regNo'));
        // $pdfPath = "registrations/reg_{$regNo}.pdf";
        // Storage::disk('local')->put("public/{$pdfPath}", $pdf->output());

        // Update applicant
        $applicant->update([
            'status'          => 'approved',
            'registration_no' => $regNo,
            // 'final_pdf'       => $pdfPath,
        ]);

        return redirect()->route('admin.pending')->with('success', "Applicant approved. Registration No: $regNo");
    }


    protected static function subjectCodes()
{
    return [
        'English'     => 'TENG',
        'Maths'       => 'TMAT',
        'Hindi'       => 'THIN',
        'Agriculture' => 'TAGR',
    ];
}
}
