<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Vehicle;
use App\Http\Requests\CreateVehicleRequest;


class MakerVehiclesController extends Controller
{
    public function __construct(){
        $this->middleware('auth.basic.once',['except'=>['index','show']]);
    }

    public function index($id){
    	$makers = Maker::find($id);
        if(!$makers){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }else{
            return response()->json(['data'=>$makers->vehicles],200); //this brings all vehicles associated with Makers :)
        }
    }

    public function store(CreateVehicleRequest $request, $maker_id){
        $maker = Maker::find($maker_id);
        
        if(!$maker){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }

        $values = $request->all();
        $maker->vehicles()->create($values);
        return response()->json(['message'=>'New vehicle is created successfully'],201);
    }

    public function show($id,$vehicleID){
    	$makers = Maker::find($id);
        if(!$makers){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }else{
            $vehicle = $makers->vehicles->find($vehicleID);

            if(!$vehicle){
                return response()->json(['message'=>'There is not any Vehicle associated with that ID','code'=>404],404);
             }
            return response()->json(['data'=> $vehicle],200); //this brings all vehicles associated with Makers :)
        }
    }

    public function update(CreateVehicleRequest $request, $maker_id,$vehicle_id){
    	
        $maker = Maker::find($maker_id);
        
        if(!$maker){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }

        $vehicle =$maker->vehicles()->find($vehicle_id);
        
        if(!$vehicle){
            return response()->json(['message'=>'There is not any data associated with this vehicle ID','code'=>404],404);
        }        

        $color = $request->get('color');
        $power = $request->get('power');
        $capacity = $request->get('capacity');
        $speed = $request->get('speed');

        $vehicle->color = $color;
        $vehicle->power = $power;
        $vehicle->capacity = $capacity;
        $vehicle->speed = $speed;

        $vehicle->save();
        return response()->json(['message'=>'Vehicle has been updated'],200);

    }

    public function destroy($maker_id,$vehicle_id){
    	$maker = Maker::find($maker_id);
        
        if(!$maker){
            return response()->json(['message'=>'There is not any data associated with this maker ID','code'=>404],404);
        }       

        $vehicles = $maker->vehicles->find($vehicle_id);

        if(!$vehicles){
            return response()->json(['message'=>'There is not vehicle associated with this vehicle ID','code'=>409],409);
        }

        $vehicles->delete();
        return response()->json(['message'=>'Vehicle is deleted successfully'],200);
    }
}
