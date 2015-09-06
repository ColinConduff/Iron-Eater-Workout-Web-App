<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Plan;
use App\PlanWorkout;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Instantiate a new PlanController instance.
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
    public function index()
    {
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

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'header' =>  ['left' => 'prev', 'center' => 'title', 'right' => 'next']
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            ]); 

        return view('plans.showAll', compact('plans', 'calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createStep1()
    {
        return view('plans.createStep1');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\PlanRequest $request)
    {
        $plan = new Plan($request->all());

        Auth::user()->plans()->save($plan);

        $plan_id = $plan->id;

        return redirect()->action('PlanController@createStep2', [$plan_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createStep2($plan_id)
    {
        $plan = Plan::with('planWorkouts')->findOrFail($plan_id);

        $workouts = Auth::user()->workouts()
            ->select('workouts.id', 'workouts.title')
            ->lists('title', 'id');

        $exercises = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('plans.createStep2', compact('plan', 'workouts', 'exercises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createStep3($plan_id)
    {
        $plan = Plan::with('planWorkouts.planDates')->findOrFail($plan_id);

        $events = [];

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

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'header' =>  ['left' => 'prev', 'center' => 'title', 'right' => 'next']
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            ]); 

        return view('plans.createStep3', compact('plan', 'calendar'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $plan = Plan::with('planWorkouts')->findOrFail($id);

        $events = [];

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

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'header' =>  ['left' => 'prev', 'center' => 'title', 'right' => 'next']
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            ]); 

        return view('plans.showOne', compact('plan', 'calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $plan = Plan::with('planWorkouts')->findOrFail($id);

        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\PlanRequest $request, $id)
    {
        $plan = Auth::user()->plans()->findOrFail($id);

        $plan->update($request->all());

        return redirect()->action('PlanController@show', [$plan->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->action('PlanController@index');
    }
}
