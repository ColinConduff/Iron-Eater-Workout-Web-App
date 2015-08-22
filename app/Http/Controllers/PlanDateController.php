<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
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
