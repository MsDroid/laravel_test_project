<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(){ return true; }
    public function rules()
    {
        // Expect an array of educations
        return [
            'educations' => 'required|array|min:1',
            'educations.*.level' => 'required|string',
            'educations.*.subjects' => 'nullable|string',
            'educations.*.board_university' => 'nullable|string',
            'educations.*.year_of_passing' => 'nullable|digits:4',
            'educations.*.marks_obtained' => 'nullable|integer|min:0',
            'educations.*.marks_total' => 'nullable|integer|min:1',
            'educations.*.certificate_no' => 'nullable|string',
        ];
    }

    public function withValidator($v)
    {
        $v->after(function($validator){
            $eds = $this->input('educations',[]);
            foreach($eds as $ed){
                if(in_array($ed['level'], ['Graduate']) && isset($ed['marks_obtained'],$ed['marks_total'])) {
                    $percent = ($ed['marks_total']>0) ? ($ed['marks_obtained']/$ed['marks_total'])*100 : 0;
                    if($percent < 50) $validator->errors()->add('educations', "Graduate minimum is 50%.");
                }
                if(in_array($ed['level'], ['Post-Graduation']) && isset($ed['marks_obtained'],$ed['marks_total'])) {
                    $percent = ($ed['marks_total']>0) ? ($ed['marks_obtained']/$ed['marks_total'])*100 : 0;
                    if($percent < 60) $validator->errors()->add('educations', "Post-Graduation minimum is 60%.");
                }
                if(in_array($ed['level'], ['B.Ed']) && isset($ed['marks_obtained'],$ed['marks_total'])) {
                    $percent = ($ed['marks_total']>0) ? ($ed['marks_obtained']/$ed['marks_total'])*100 : 0;
                    if($percent < 60) $validator->errors()->add('educations', "B.Ed minimum is 60%.");
                }
            }
        });
    }
}
