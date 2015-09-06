<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Carbon\Carbon;
use App\Workout;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Instantiate a new DashboardController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function displayDashboard()
    {
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

        $plans = Auth::user()->plans()->get();

        $events = [];

        foreach($plans as $plan)
        {
            foreach($plan->planWorkouts as $planWorkout)
            {
                foreach($planWorkout->planDates as $planDate)
                {
                    $events[] = \Calendar::event(
                        $planDate->planWorkout->workout->title, //event title
                        true, //full day event?
                        $planDate->planned_date, //start time (you can also use Carbon instead of DateTime)
                        $planDate->planned_date //end time (you can also use Carbon instead of DateTime)
                    );
                }
            }
        }

        // Documentation to help with interacting with madhatters fullCalendar.io interface
        //
        // $calendar = \Calendar::addEvents($events) //add an array with addEvents
        //     ->setOptions([ //set fullcalendar options
        //         'weekends' => false,
        //         'header' =>  ['left' => 'prev', 'center' => 'title', 'right' => 'next']
        //     ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        //         'viewRender' => 'function() {alert("Callbacks!");}'
        //     ]); 
 
        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'header' =>  ['left' => 'prev', 'center' => 'title', 'right' => 'next']
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            ]); 

        return view('dashboard', compact('todaysWorkoutList', 'planWorkoutList', 'exerciseList', 'plans', 'calendar'));
    }
}
