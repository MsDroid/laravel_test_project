<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterApplicantRequest;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegistrationForm(){ return view('applicants.register'); }

    public function register(RegisterApplicantRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // create applicant skeleton
        $app = Applicant::create([
            'user_id' => $user->id,
            'advt_no' => $data['advt_no'] ?? null,
            'already_applied' => (bool)$data['already_applied'],
            'post' => $data['post'],
            'subject' => $data['subject'],
            'bed_required' => ($data['subject'] === 'Agriculture') ? false : true,
            'gender' => $data['gender'],
            'physically_handicapped' => (bool)$data['physically_handicapped'],
            'handicap_details' => $data['handicap_details'] ?? null,
            'category' => $data['category'],
            'dob' => $data['dob'],
            'full_name' => $data['full_name'],
            'mobile' => $data['mobile'],
            "current_step" => $data['already_applied'] == '1' ? '2' : '1',
        ]);

        event(new Registered($user)); // sends verification email if configured

        return redirect()->route('verification.notice')->with('status','Registered. Verify email.');
    }
}
