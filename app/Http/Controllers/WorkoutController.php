<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Auth;
use DB;
use App\Session;
use App\Workout;
use App\Exercise;
use App\SessionSet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkoutController extends Controller
{
    /**
     * Instantiate a new WorkoutController instance.
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
        $workouts = Auth::user()->workouts()->get();

        return view('workouts.showAll', compact('workouts'));
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
    public function store(Requests\WorkoutRequest $request)
    {
        $workout = new Workout($request->all());

        Auth::user()->workouts()->save($workout);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $workout = Auth::user()->workouts()->findOrFail($id);

        return view('workouts.showOne', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $workout = Auth::user()->workouts()->findOrFail($id);

        return view('workouts.edit', compact('workout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,  Requests\WorkoutRequest $request)
    {
        $workout = Auth::user()->workouts()->findOrFail($id);

        $workout->update($request->all());

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
        $workout = Auth::user()->workouts()->findOrFail($id);
        $workout->delete();

        return redirect()->action('WorkoutController@index');
    }
}
