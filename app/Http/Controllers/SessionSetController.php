<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SessionSet;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionSetController extends Controller
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
     * @return Response
     */
    public function store(Requests\SessionSetRequest $request)
    {
        $sessionSet = new SessionSet;
        $sessionSet->session_id = $request->session_id;
        $sessionSet->number_of_reps = $request->number_of_reps;
        $sessionSet->weight_lifted = $request->weight_lifted;
        $sessionSet->save();

        return redirect()->action('WorkoutController@show', ['id' => $request->workout_id]);
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
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\SessionSetRequest $request)
    {
        $sessionSet = SessionSet::findOrFail($id);

        $sessionSet->update($request->all());

        $sessionSet = SessionSet::with('session')->findOrFail($id);

        return redirect()->action('WorkoutController@show', ['id' => $sessionSet->session->workout_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $sessionSet = SessionSet::findOrFail($id);
        $workoutID = DB::table('sessions')->select('workout_id')->find($sessionSet->session_id);
        $sessionSet->delete();

        return redirect()->action('WorkoutController@show', ['id' => $workoutID->workout_id]);
    }
}






















