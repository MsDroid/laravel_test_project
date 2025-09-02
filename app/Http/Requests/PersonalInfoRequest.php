<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
{
    public function authorize(){ return true; }
    public function rules()
    {
        return [
            'category_certificate_no' => 'nullable|string|max:255',
            'address' => 'required|string|max:2000',
            'photo_id_type' => 'required|in:Aadhaar,PAN',
            'photo_id_no' => 'required|string|max:50',
            'photo_id_image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            // education blocks handled in EducationRequest via separate endpoint
        ];
    }
}
