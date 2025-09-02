<?php 

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(){ return true; }
    public function rules()
    {
        return [
            'bank_name' => 'required|string',
            'amount' => 'required|integer|min:0',
            'payment_ref' => 'required|string',
            'payment_date' => 'required|date',
            'receipt_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
