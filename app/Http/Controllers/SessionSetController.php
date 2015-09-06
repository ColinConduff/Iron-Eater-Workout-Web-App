<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SessionSet;
use App\Exercise;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionSetController extends Controller
{
    /**
     * Instantiate a new SessionSetController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calculateOneRepMax($weight, $repetitions)
    {
        //Brzycki Formula 
        $oneRepMax = 0;
        if($repetitions < 37)
        {
            $oneRepMax = $weight*36 / (37 - $repetitions);
        }
        return $oneRepMax;
    }

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
    public function store(Requests\SessionSetRequest $request)
    {
        $sessionSet = new SessionSet;
        $sessionSet->session_id = $request->session_id;
        $sessionSet->number_of_reps = $request->number_of_reps;
        $sessionSet->weight_lifted = $request->weight_lifted;
        $sessionSet->one_rep_max = $this->calculateOneRepMax($sessionSet->weight_lifted, $sessionSet->number_of_reps);
        $sessionSet->failed = 0;
        $sessionSet->save();

        // refactor this code; create function in ExerciseController to update exercise

            $exercise = Auth::user()->exercises()->findOrFail($sessionSet->session->exercise_id);

            $bestOneRepMax = SessionSet::join('sessions', 'sessions.id', '=', 'session_sets.session_id')
                ->where('sessions.exercise_id', '=', $exercise->id)
                ->max('one_rep_max');

            $exercise->update(['best_one_rep_max' => $bestOneRepMax]);

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
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\SessionSetRequest $request)
    {
        $sessionSet = SessionSet::with('session.exercise')->findOrFail($id);
        $sessionSet->one_rep_max = $this->calculateOneRepMax($request->weight_lifted, $request->number_of_reps);
        
        // If the user is updating the weight and reps with lower values, 
        // then they likely failed the set (especially if the set was 
        // generated from a plan).  However, if it was not generated from a plan
        // this could be an incorrect assumption...
        if($request->weight_lifted < $sessionSet->weight_lifted or $request->number_of_reps < $sessionSet->number_of_reps)
        {
            $sessionSet->update(['failed' => 1]);
        }

        $sessionSet->update($request->all());

        // refactor this code; create function in ExerciseController to update exercise best_one_rep_max

            $exercise = Auth::user()->exercises()->findOrFail($sessionSet->session->exercise_id);

            $bestOneRepMax = SessionSet::join('sessions', 'sessions.id', '=', 'session_sets.session_id')
                ->where('sessions.exercise_id', '=', $exercise->id)
                ->max('one_rep_max');

            $exercise->update(['best_one_rep_max' => $bestOneRepMax]);

        return back()->with('status', 'Successful Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $sessionSet = SessionSet::findOrFail($id);
        $sessionSet->delete();

        return back();
    }
}






















