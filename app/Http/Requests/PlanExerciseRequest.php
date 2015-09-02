<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlanExerciseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight_to_add_for_success' => 'required',
            'weight_to_sub_for_fail' => 'required'
        ];
    }
}
