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

    public function update($id){
    	
    }

    public function destroy($id){
    	
    }
}