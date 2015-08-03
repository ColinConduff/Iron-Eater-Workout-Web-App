<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Exercise;
use App\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExerciseController extends Controller
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
        $exercises = Auth::user()->exercises()->get();

        return view('exercises.showAll', compact('exercises'));
    }

    // *
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
     
    // public function create()
    // {
    //     return view('exercises.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\ExerciseRequest $request)
    {
        $type = $request->input('type');
        $category = $request->input('category');
        
        $exercise = new Exercise;
        $exercise->title = $request->title;
        $exercise->type = $request->type;
        $exercise->category = $request->category;

        Auth::user()->exercises()->save($exercise);

        return redirect('exercises');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $exercise = Auth::user()->exercises()->findOrFail($id);

        $sessions = Session::where('exercise_id', '=', $exercise->id)
            ->orderBy('session_date', 'desc')->with('sessionSets')->paginate(2);

        return view('exercises.showOne', compact('exercise', 'sessions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $exercise = Auth::user()->exercises()->findOrFail($id);

        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\ExerciseRequest $request)
    {
        $exercise = Auth::user()->exercises()->findOrFail($id);

        $exercise->update($request->all());

        return redirect()->action('ExerciseController@show', [$exercise->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $exercise = Auth::user()->exercises()->findOrFail($id);
        $exercise->delete();

        return redirect('exercises');
    }

    public function sortTitleAsc()
    {
        $exercises = Auth::user()->exercises()
            ->orderBy('title','asc')->get();

        return view('exercises.showAll', compact('exercises'));
    }

    public function sortTitleDesc()
    {
        $exercises = Auth::user()->exercises()
            ->orderBy('title','desc')->get();

        return view('exercises.showAll', compact('exercises'));
    }

    public function filterByType($type)
    {
        $exercises = Auth::user()->exercises()
            ->where('type', '=', $type)->get();

        return view('exercises.showAll', compact('exercises'));
    }

    public function filterByCategory($category)
    {
        $exercises = Auth::user()->exercises()
            ->where('category', '=', $category)->get();

        return view('exercises.showAll', compact('exercises'));
    }
}



















