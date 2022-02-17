<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Response;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getState(Request $request)
    {

         $getCountryID = $request->country_id;
         $state = State::where('country_id',$getCountryID)->get();
         return Response::json($state);

    }

    
}
