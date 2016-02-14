<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vehicle;

class VehicleController extends Controller
{
    
	public function __construct(){
		$this->middleware('auth.basic.once',['except'=>['index','show']]);
	}

    /**
	* Display a listing of the resource
	*
	* @return Response
    */
    
    public function index(){
    	$vehicles = Vehicle::all();

    	return response() -> json( ['data' => $vehicles],200);
    }
}
