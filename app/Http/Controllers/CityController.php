<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCity(Request $request)
    {
        $state_id = $request->state_id;
        $city = City::where('state_id', $state_id)->get();
        return  $getCity = Response::json($city);
    }

    
}
