<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\PlanExercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\PlanExerciseRequest $request)
    {
        $exerciseID = $request->input('id');

        $planExercise = new PlanExercise;
        $planExercise->exercise_id = $exerciseID[0];
        $planExercise->plan_workout_id = $request->plan_workout_id;
        $planExercise->weight_to_add_for_success = $request->weight_to_add_for_success;
        $planExercise->weight_to_sub_for_fail  = $request->weight_to_sub_for_fail;
        $planExercise->save();

        return redirect()->action('PlanController@createStep2', [$request->plan_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $planExercise = PlanExercise::findOrFail($id); 

        $exercises = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('plans.editPlanExercise', compact('planExercise', 'exercises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\PlanExerciseRequest $request, $id)
    {
        $planExercise = PlanExercise::findOrFail($id);

        $exerciseID = $request->input('id');
        $planExercise->exercise_id = $exerciseID[0];
        $planExercise->update($request->all());

        return redirect()->action('PlanController@show', [$request->plan_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $planExercise = PlanExercise::findOrFail($id);
        $planExercise->delete();

        return redirect()->action('PlanController@show', [$plan_id]);
    }
}
