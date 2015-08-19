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
        $workouts = Auth::user()->workouts()->get();

        $workoutDeletables = Workout::select('workouts.id', 'workouts.title')
            ->lists('title', 'id');

        return view('dashboard', compact('workouts', 'workoutDeletables'));
    }
}
