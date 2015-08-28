<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PlanExercise;
use App\PlanSet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanSetController extends Controller
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
    public function store(Request $request)
    {
        $planSet = new PlanSet($request->all());
        $planSet->save();

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
        $planSet = PlanSet::findOrFail($id);
        $planExercise = PlanExercise::with('planSets', 'planWorkout')->findOrFail($planSet->plan_exercise_id);

        return view('plans.editPlanSets', compact('planExercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $planSet = PlanSet::findOrFail($id);

        $planSet->update($request->all());

        return back()->with('status', 'Successful update!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $planSet = PlanSet::findOrFail($id);
        $plan_id = $planSet->planExercise->planWorkout->plan_id;
        $planSet->delete();

        return redirect()->action('PlanController@show', [$plan_id]);
    }
}
