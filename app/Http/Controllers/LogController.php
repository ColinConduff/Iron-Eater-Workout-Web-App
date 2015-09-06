<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Session;
use App\PlanWorkout;
use App\PlanExercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Instantiate a new PlanController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function showLog()
    {
        $currentSessions = Auth::user()->sessions()
            ->with('exercise', 'sessionSets')
            ->where('session_date', '>', Carbon::today())
            ->orderBy('session_date', 'desc')
            ->get();

        $user = Auth::user();

        // Exercises added to a log after a log was generated with a plan will have 
        // access to buttons for successfulLift and failedLift, even though that 
        // exercise is not in a plan. If they click those buttons they will send 
        // an incorrect planWorkout->id to those functions.
        $planWorkout = PlanWorkout::join('workouts', 'workouts.id', '=', 'plan_workouts.workout_id')
            ->join('plan_exercises', 'plan_workouts.id', '=', 'plan_exercises.plan_workout_id')
            ->join('exercises', 'exercises.id', '=', 'plan_exercises.exercise_id')
            ->join('sessions', 'exercises.id', '=', 'sessions.exercise_id')
            ->where('session_date', '>', Carbon::today())
            ->join('plans', 'plans.id', '=', 'plan_workouts.plan_id')
            ->where('plans.user_id', '=', $user->id)
            ->select('plan_workouts.id', 'plan_workouts.workout_id', 'workouts.title', 'workouts.note')
            ->first();

        $todaysWorkoutList = Auth::user()->plans()
            ->join('plan_workouts', 'plans.id', '=', 'plan_workouts.plan_id')
            ->join('workouts', 'workouts.id', '=', 'plan_workouts.workout_id')
            ->join('plan_dates', 'plan_workouts.id', '=', 'plan_dates.plan_workout_id')
            ->whereBetween('plan_dates.planned_date', 
                [Carbon::today(), Carbon::today()->addDay()->subMinute()])
            ->select('plan_workouts.id', 'workouts.title')
            ->lists('title', 'id');

        $planWorkoutList = Auth::user()->plans()
            ->join('plan_workouts', 'plans.id', '=', 'plan_workouts.plan_id')
            ->join('workouts', 'workouts.id', '=', 'plan_workouts.workout_id')
            ->select('plan_workouts.id', 'workouts.title')
            ->lists('title', 'id');

        $exerciseList = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');


        return view('log.show', compact('currentSessions', 'planWorkout', 'exerciseList', 'planWorkoutList', 'todaysWorkoutList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editLog()
    {
        $currentSessions = Auth::user()->sessions()
            ->with('exercise', 'sessionSets')
            ->where('session_date', '>', Carbon::today())
            ->orderBy('session_date', 'desc')
            ->get();

        $exerciseList = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('log.edit', compact('currentSessions', 'exerciseList'));
    }

    /**
     * 
     */
    public function successfulLift(Request $request)
    {
        $planExercise = PlanExercise::join('plan_workouts', 'plan_workouts.id', '=', 'plan_exercises.plan_workout_id')
            ->where('plan_workouts.id', '=', $request->input('plan_workout_id'))
            ->join('exercises', 'exercises.id', '=', 'plan_exercises.exercise_id')
            ->where('exercises.title', '=', $request->input('exercise_title'))
            ->select('plan_exercises.id', 'plan_exercises.weight_to_add_for_success', 
                'plan_exercises.weight_to_sub_for_fail', 'exercises.title')
            ->with('planSets')
            ->first();

        // If there is not a planExercise associated with the planWorkout send back error message
        if(count($planExercise))
        {
            foreach($planExercise->planSets as $planSet)
            {
                $planSet->update(['expected_weight' 
                    => $planSet->expected_weight + $planExercise->weight_to_add_for_success]);
            }

            $message = 'Successful Lift! ' . $planExercise->weight_to_add_for_success . 
                ' pounds added to future planned sets of ' . 
                $planExercise->title;

            return back()->with('status', $message);
        }
        else
        {
            $message = 'Sorry, there is no plan associated with ' . $planExercise->title . ' to update.' ;

            return back()->with('status', $message);
        }
    }

    /**
     */
    public function failedLift(Request $request)
    {
       $planExercise = PlanExercise::join('plan_workouts', 'plan_workouts.id', '=', 'plan_exercises.plan_workout_id')
            ->where('plan_workouts.id', '=', $request->input('plan_workout_id'))
            ->join('exercises', 'exercises.id', '=', 'plan_exercises.exercise_id')
            ->where('exercises.title', '=', $request->input('exercise_title'))
            ->select('plan_exercises.id', 'plan_exercises.weight_to_add_for_success', 
                'plan_exercises.weight_to_sub_for_fail', 'exercises.title')
            ->with('planSets')
            ->first();

        // If there is not a planExercise associated with the planWorkout send back error message
        if(count($planExercise))
        {
            foreach($planExercise->planSets as $planSet)
            {
                $planSet->update(['expected_weight' 
                    => $planSet->expected_weight - $planExercise->weight_to_sub_for_fail]);
            }

            $message = 'Failed Lift! ' . $planExercise->weight_to_sub_for_fail . 
                ' pounds subtracted from future planned sets of ' . 
                $planExercise->title;

            return redirect('editLog')->with('status', $message);
        }
        else
        {
            $message = 'Sorry, there is no plan associated with ' . $planExercise->title . ' to update.' ;

            return back()->with('status', $message);
        }
    }
}
