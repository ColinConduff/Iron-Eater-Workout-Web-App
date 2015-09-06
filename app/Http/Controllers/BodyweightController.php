<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Bodyweight;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BodyweightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        $bodyweights = Auth::user()->bodyweights()->with('user')->get();

        return view('bodyweight.show', compact('user', 'bodyweights'));
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
        $this->validate($request, ['bodyweight' => 'required|integer|min:36']);

        $user = Auth::user();
        
        if($user->height_inches)
        {
            $bodyWeight = new Bodyweight;
            $bodyWeight->bodyweight = $request->bodyweight;
            $bodyWeight->user_id = $user->id;
            $bodyWeight->bmi = ($bodyWeight->bodyweight * 0.45) / pow(($user->height_inches * 0.025), 2); 
            $bodyWeight->save();

            $message = 'Successfully added new body weight! Keep up the good work!';
        }
        else
        {
            $message = 'Please add your height first!';
        }

        return back()->with('status', $message);

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
        $this->validate($request, ['bodyweight' => 'required|integer|min:36']);

        $user = Auth::user();
        if($user->height_inches)
        {
            $bodyWeight = Bodyweight::findOrFail($id);
            $bodyWeight->bodyweight = $request->bodyweight;
            $bodyWeight->user_id = $user->id;
            $bodyWeight->bmi = ($bodyWeight->bodyweight * 0.45) / pow(($user->height_inches * 0.025), 2); 
            $bodyWeight->save();

            $message = 'Successfully updated your body weight! Keep up the good work!';
        }
        else
        {
            $message = 'Please add your height first!';
        }

        return back()->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $bodyweight = Bodyweight::findOrFail($id);
        $bodyweight->delete();

        return redirect('bodyweights');
    }
}
