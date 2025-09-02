<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class RegisterApplicantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'mobile' => ['required','regex:/^[0-9]{10}$/'],
            'password' => 'required|min:8|confirmed',
            'advt_no' => 'nullable|string',
            'already_applied' => 'required|in:0,1',
            'post' => 'required|string',
            'subject' => 'required|string',
            'gender' => 'required|in:Male,Female,Others',
            'physically_handicapped' => 'required|in:0,1',
            'handicap_details' => 'nullable|string',
            'category' => 'required|in:General,ST,SC,OBC',
            'dob' => 'required|date_format:Y-m-d',
        ];
    }


     public function withValidator($validator)
    {
        $validator->after(function($v) {
            $data = $this->validated();
            // Age restrictions: calculate age as on 2024-01-01
            $dob = \Carbon\Carbon::parse($data['dob']);
            $asOn = \Carbon\Carbon::create(2024,1,1);
            $age = $dob->diffInYears($asOn);

            // determine max by rules
            $max = 40; // default general
            if ($data['category'] === 'General' && $data['physically_handicapped']) $max = 45;
            if ($data['category'] === 'ST') {
                $max = ($data['gender'] === 'Female') ? 45 : 43;
            }
            if ($data['category'] === 'SC') {
                $max = ($data['gender'] === 'Female') ? 48 : 45;
            }
            if ($data['category'] === 'OBC') {
                $max = ($data['gender'] === 'Female') ? 50 : 47;
            }

            if ($age < 25 || $age > $max) {
                $v->errors()->add('dob', "Age must be between 25 and $max years as on 2024-01-01. Computed age: $age");
            }

            // B.Ed mandatory conditions
            if ($data['subject'] !== 'Agriculture') {
                // we'll enforce B.Ed presence in education step; add a hint here
            }
        });
    }
}
