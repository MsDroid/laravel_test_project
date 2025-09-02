<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Support\Str;

class AdminApplicationController extends Controller
{
    public function __construct(){ $this->middleware(['auth','can:admin']); }

    public function indexPending()
    {
        $apps = Applicant::where('status','pending')->paginate(20);
        return view('admin.applications.pending', compact('apps'));
    }

    public function show($id)
    {
        $app = Applicant::with('user','payments','educations','documents')->findOrFail($id);
        return view('admin.applications.show', compact('app'));
    }

    public function approve($id)
    {
        $app = Applicant::findOrFail($id);
        // create registration number
        $subjectCode = $this->subjectCode($app->subject);
        $regNo = sprintf('CED/%s/2024/%06d', $subjectCode, rand(100000,999999));
        $app->registration_no = $regNo;
        $app->status = 'approved';
        $app->save();

        // TODO: create PDF of registration and email to user

        return redirect()->back()->with('success','Application approved and registration no generated: '.$regNo);
    }

    public function reject($id)
    {
        $app = Applicant::findOrFail($id);
        $app->status = 'rejected';
        $app->save();
        return redirect()->back()->with('success','Application rejected');
    }

    protected function subjectCode($subject)
    {
        $map = [
            'English' => 'TENG',
            'Maths' => 'TMTS',
            'Hindi' => 'THIN',
            'Agriculture' => 'TAGR',
        ];
        return $map[$subject] ?? Str::upper(substr($subject,0,4));
    }
}
