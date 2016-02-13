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

    public function update(CreateMakerRequest $request,$maker_id){
    	$maker = Maker::find($maker_id);
        
        if(!$maker){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }

        $name = $request->get('name');
        $phone = $request->get('phone');

        $maker->name = $name;
        $maker->phone = $phone;
        $maker->save();
        return response()->json(['message'=>'Maker has been updated'],200);
    }

    public function destroy($maker_id){
		$maker = Maker::find($maker_id);
        
        if(!$maker){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }    	

        $vehicles = $maker->vehicles;

        if(sizeof($vehicles) > 0){
        	return response()->json(['message'=>'This maker ID has vehicles so please delete vehicles first','code'=>409],409);
        }

        $maker->delete();
        return response()->json(['message'=>'Maker is deleted successfully'],200);
    }
}
