<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PlanWorkout;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanWorkoutController extends Controller
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
    public function store(Requests\PlanWorkoutRequest $request)
    {
        $workoutIDs = $request->input('id');

        foreach($workoutIDs as $workoutID)
        {
            $planWorkout = new PlanWorkout;
            $planWorkout->workout_id = $workoutID;
            $planWorkout->plan_id = $request->plan_id;
            $planWorkout->save();
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
