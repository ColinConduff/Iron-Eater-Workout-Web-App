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
     * Instantiate a new UserController instance.
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
        // $workouts = Auth::user()->workouts()->get();

        // return view('workouts.showAll', compact('workouts'));
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

        return redirect()->action('WorkoutController@show', ['id' => $workout->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user(); // not necessary?

        $workout = Auth::user()->workouts()->findOrFail($id);

        $pastSessions = Session::with('exercise', 'sessionSets')
            ->where('workout_id', '=', $workout->id)
            ->where('session_date', '<', Carbon::today())
            ->orderBy('session_date', 'desc')
            ->paginate(4);

        $currentSessions = Session::with('exercise', 'sessionSets')
            ->where('workout_id', '=', $workout->id)
            ->where('session_date', '>', Carbon::today())
            ->orderBy('session_date', 'desc')
            ->get();

        $exercises = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('workouts.showOne', compact('workout', 'pastSessions', 'currentSessions', 'exercises'));
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

        $currentSessions = Session::with('exercise', 'sessionSets')
            ->where('workout_id', '=', $workout->id)
            ->where('session_date', '>', Carbon::today())
            ->orderBy('session_date', 'desc')
            ->get();

        $exerciseList = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('workouts.edit', compact('workout', 'currentSessions', 'exerciseList'));
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

        return redirect()->action('WorkoutController@show', ['id' => $workout->id]);
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

        return redirect()->action('DashboardController@displayDashboard');
    }
}
