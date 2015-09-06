<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Auth;
use DB;
use App\PlanWorkout;
use App\PlanExercise;
use App\SessionSet;
use App\Session;
use App\Exercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * Instantiate a new SessionController instance.
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
        $sessions = Auth::user()->sessions()
            ->with('exercise', 'sessionSets')
            ->orderBy('session_date', 'desc')
            ->paginate(10);

        $exerciseList = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        $workoutList = Auth::user()->workouts()
            ->select('workouts.id', 'workouts.title')
            ->lists('title', 'id');

        return view('sessions.showAll', compact('sessions', 'exerciseList', 'workoutList'));
    }

    public function sendExerciseID(Request $request)
    {
        $exerciseID = $request->input('id');

        return redirect()->action('SessionController@filterByExerciseTitle', [$exerciseID[0]]);
    }

    public function filterByExerciseTitle($exerciseID)
    {
        $sessions = Auth::user()->sessions()
            ->with('exercise', 'sessionSets')
            ->where('exercise_id', '=', $exerciseID)
            ->orderBy('session_date', 'desc')
            ->paginate(5);

        $exerciseList = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        $workoutList = Auth::user()->workouts()
            ->select('workouts.id', 'workouts.title')
            ->lists('title', 'id');

        return view('sessions.showAll', compact('sessions', 'exerciseList', 'workoutList'));
    }

    /**
     * 
     *
     * 
     */
    public function generateLogFromWK(Request $request)
    {
        $planExercises = PlanExercise::with('planSets')->where('plan_workout_id', '=', $request->input('id'))->get();

        foreach($planExercises as $planExercise)
        {
            $session = new Session;
            $session->exercise_id = $planExercise->exercise->id;
            $session->session_date = Carbon::now();
            Auth::user()->sessions()->save($session);

            foreach($planExercise->planSets as $planSet)
            {
                $sessionSet = new SessionSet;
                $sessionSet->session_id = $session->id;
                $sessionSet->number_of_reps = $planSet->expected_reps;
                $sessionSet->weight_lifted = $planSet->expected_weight;
                $sessionSet->one_rep_max = $sessionSet->weight_lifted * 36 / (37 - $sessionSet->number_of_reps); 
                $sessionSet->failed = 0;
                $sessionSet->save();

                $exercise = Auth::user()->exercises()->findOrFail($sessionSet->session->exercise_id);
                $bestOneRepMax = SessionSet::join('sessions', 'sessions.id', '=', 'session_sets.session_id')
                    ->where('sessions.exercise_id', '=', $exercise->id)
                    ->max('one_rep_max');
                $exercise->update(['best_one_rep_max' => $bestOneRepMax]);
            }
        }

        return redirect()->action('LogController@showLog'); 
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
            $session->exercise_id = $exerciseID;
            $session->session_date = Carbon::now();
            Auth::user()->sessions()->save($session);
        }

        return redirect()->action('LogController@showLog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $session = Auth::user()->sessions()->findOrFail($id);

        return view('sessions.showOne', compact('session'));
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

        $exercises = Auth::user()->exercises()
            ->select('exercises.id', 'exercises.title')
            ->lists('title', 'id');

        return view('sessions.edit', compact('session', 'exercises'));
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

        $session->exercise_id = $request->input('id');

        $session->update($request->all());

        return redirect()->action('LogController@showLog');
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
        $session->delete();

        return back();
    }
}
