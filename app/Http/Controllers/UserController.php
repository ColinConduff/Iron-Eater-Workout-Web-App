<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
    	$this->validate($request, ['height_inches' => 'required|integer|min:36']);

    	$user = Auth::user();
        $user->height_inches = $request->height_inches;
        $user->save();

        return back();
    }
}
