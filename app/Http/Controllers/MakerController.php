<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;

class MakerController extends Controller
{
    public function index(){
    	$makers = Maker::all();

    	return response() -> json( ['data' => $makers],200);
    }

    public function store(){
    	
    }

    public function show($id){
    	$makers = Maker::find($id);
    	if(!$makers){
    		return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$makers],200);
    	}
    	
    }

    public function update($id){
    	
    }

    public function destroy($id){
    	
    }
}
