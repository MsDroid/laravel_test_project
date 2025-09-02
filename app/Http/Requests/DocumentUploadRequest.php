<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DocumentUploadRequest extends FormRequest
{
    public function authorize(){ return true; }
    public function rules()
    {
        // depending on frontend, accept single or multiple
        return [
            'documents' => 'required|array',
            'documents.*.type' => 'required|string',
            'documents.*.file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
