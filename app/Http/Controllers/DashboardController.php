<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use App\Workout;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function displayDashboard()
    {
        $workouts = Auth::user()->workouts()->get();

        $workoutDeletables = Workout::select('workouts.id', 'workouts.title')
            ->lists('title', 'id');

        return view('dashboard', compact('workouts', 'workoutDeletables'));
    }

    // public function edit($id)
    // {
    //     $user = Auth::user(); // not necessary?

    //     $workout = Auth::user()->workouts()->findOrFail($id);

    //     $pastSessions = Session::with('exercise', 'sessionSets')
    //         ->where('workout_id', '=', $workout->id)
    //         ->orderBy('session_date', 'desc')
    //         ->get();

    //     $exercises = DB::table('sessions')->distinct()
    //         ->join('exercises', 'exercises.id', '=', 'sessions.exercise_id')
    //         ->join('workouts', 'workouts.id', '=', 'sessions.workout_id')
    //         ->where('sessions.workout_id', '=', $workout->id)
    //         ->select('exercises.id', 'exercises.title')
    //         ->lists('title', 'id');

    //     return view('workouts.showOne', compact('workout', 'pastSessions', 'currentSessions', 'exercises'));
    // }
}
