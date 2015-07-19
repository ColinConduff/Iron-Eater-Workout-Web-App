<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ExerciseRequest extends Request
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
            'title' => 'required',
            'type' => 'required|in:array([Cardio,Weighted,Bodyweight,Yoga])',
            'category' => 'required|in:array([Chest,Back,Triceps,Biceps,Legs,Shoulders,Full Body])'
        ];
    }
}
