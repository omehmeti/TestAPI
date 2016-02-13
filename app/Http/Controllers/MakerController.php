<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Http\Requests\CreateMakerRequest;

class MakerController extends Controller
{
    public function index(){
    	$makers = Maker::all();

    	return response() -> json( ['data' => $makers],200);
    }

    public function store( CreateMakerRequest $request ){
    	  $values = $request->only(['name','phone']);
    	
    	  Maker::create($values);
    	  return response()->json(['message'=>'New maker is created successfully'],201);
    	
    	
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
