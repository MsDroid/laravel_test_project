<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'experiences' => 'required|array|min:1',
            'experiences.*.institution'     => 'nullable|string|max:255',
            'experiences.*.designation'     => 'nullable|string|max:255',
            'experiences.*.from'            => 'nullable|date',
            'experiences.*.to'              => 'nullable|date|after_or_equal:experiences.*.from',
            'experiences.*.total_period'    => 'nullable|string|max:100',
            'experiences.*.subjects_taught' => 'nullable|string|max:255',
            'experiences.*.status'          => 'required|in:current,previous',
        ];
    }
}
