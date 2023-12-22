<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile=profile::with('user')->get();  
        return $profile;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile=new profile();
        $profile->user_id=$request->user;
        $profile->save();
        return $profile;
    }

    /**
     * Display the specified resource.
     */
    public function show(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profile $profile)
    {
        //
    }
}
