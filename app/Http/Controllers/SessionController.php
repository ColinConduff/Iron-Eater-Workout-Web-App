<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Auth;
use DB;
use App\Session;
use App\Exercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
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
    public function store(Requests\SessionRequest $request)
    {
        $exerciseIDs = $request->input('id');

        foreach($exerciseIDs as $exerciseID)
        {
            $session = new Session;
            $session->workout_id = $request->workout_id;
            $session->exercise_id = $exerciseID;
            $session->session_date = Carbon::now();
            Auth::user()->sessions()->save($session);
        }

        return redirect()->action('WorkoutController@show', ['id' => $session->workout_id]);
    }

    public function startNewWorkout(Request $request)
    {
        $exerciseIDs = DB::table('sessions')->distinct()
            ->join('exercises', 'exercises.id', '=', 'sessions.exercise_id')
            ->join('workouts', 'workouts.id', '=', 'sessions.workout_id')
            ->where('sessions.workout_id', '=', $request->workout_id)
            ->select('exercises.id')
            ->get();

        foreach($exerciseIDs as $exerciseID)
        {
            $session = new Session;
            $session->workout_id = $request->workout_id;
            $session->exercise_id = $exerciseID->id;
            $session->session_date = Carbon::now();
            Auth::user()->sessions()->save($session);
        }

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
        $session = Auth::user()->sessions()->findOrFail($id);

        return view('sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\SessionRequest $request)
    {
        $session = Auth::user()->sessions()->findOrFail($id);

        $session->update($request->all());

        return redirect('sessions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $session = Auth::user()->sessions()->findOrFail($id);
        $workoutID = $session->workout_id;
        $session->delete();

        return redirect()->action('WorkoutController@show', ['id' => $workoutID]);
    }
}
