<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlanStep3Request extends Request
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
            'exercise_id'  => 'required',
            'weightToAddForSuccess'  => 'required',
            'weightToSubForFail'  => 'required',
            'expected_reps'  => 'required',
            'expected_weight'  => 'required'
        ];
    }
}
