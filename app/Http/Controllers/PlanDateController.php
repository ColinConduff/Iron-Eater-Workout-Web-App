<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\PlanDate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanDateController extends Controller
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
        $planEndDate = DB::table('plans')->where('id', '=', $request->input('plan_id'))->value('end_date');
        $this->validate($request, ['planned_date' => 'required|date|after:yesterday|before:'.$planEndDate]);
        
        $planDate = new PlanDate($request->all());
        $planDate->save();

        return redirect()->action('PlanController@createStep3', [$request->plan_id]);
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
        $plan = Auth::user()->plans()->with('planWorkouts')->findOrFail($id);

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
                'firstDay' => 1
            ]); 

        return view('plans.editPlanDates', compact('plan', 'calendar'));
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
        $planEndDate = DB::table('plans')->where('id', '=', $request->input('plan_id'))->value('end_date');
        $this->validate($request, ['planned_date' => 'required|date|after:yesterday|before:'.$planEndDate]);
        
        $planDate = PlanDate::findOrFail($id);
        $planDate->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $planDate = PlanDate::findOrFail($id);
        $planDate->delete();

        return back();
    }
}
