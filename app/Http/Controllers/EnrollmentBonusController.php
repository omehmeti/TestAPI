<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentBonusModel;
use App\Http\Requests\CreateEnrollmentBonusRequest;

class EnrollmentBonusController extends Controller
{
    public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	$enrollment_bonuses = Cache::remember('EnrollmentBonus',1/60,function(){
            return EnrollmentBonusModel::all();
        });

    	
        return response() -> json( ['data' => $enrollment_bonuses],200);
        
    }

    public function store( CreateEnrollmentBonusRequest $request ){
    	  $values = $request->all();
    	
    	  //EnrollmentBonusModel::create($values);

          EnrollmentBonusModel::create ([ 
            'source_code' =>  $values['source_code'], 
            'name' => $values['name'],
            'start_date'=> Carbon::createFromFormat('d.m.Y', $values['start_date']),
            'end_date' => Carbon::createFromFormat('d.m.Y', $values['end_date']),
            'reference_code' => $values['reference_code'],
            'bonus_points' => $values['bonus_points'],
            'referer_bonus_points' => $values['referer_bonus_points'] 

            ]);
    	  return response()->json(['message'=>'New EnrollmentBonus is added successfully'],201);
    	
    	
    }

    public function show($source_code){
    	$enrollment_bonuses = EnrollmentBonusModel::find($source_code);
    	if(!$enrollment_bonuses){
    		return response()->json(['message'=>'There is not any data associated with this enrollment bonus source code','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$enrollment_bonuses],200);
    	}
    	
    }

    public function update(CreateEnrollmentBonusRequest $request,$source_code){
    	$enrollment_bonus = EnrollmentBonusModel::find($source_code);
        
        if(!$enrollment_bonus){
            return response()->json(['message'=>'There is not any data associated with this enrollment bonus source code','code'=>404],404);
        }

      

        $name = $request->get('name');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $reference_code = $request->get('reference_code');
        $bonus_points = $request->get('bonus_points');
        $referer_bonus_points = $request->get('referer_bonus_points');

       
        
        $enrollment_bonus->name = $name;
        $enrollment_bonus->start_date = Carbon::createFromFormat('d.m.Y', $start_date);
        $enrollment_bonus->end_date = Carbon::createFromFormat('d.m.Y', $end_date);
        $enrollment_bonus->reference_code = $reference_code;
        $enrollment_bonus->bonus_points = $bonus_points;
        $enrollment_bonus->referer_bonus_points = $referer_bonus_points;

        $enrollment_bonus->save();
        return response()->json(['message'=>'Enrollment Bonus has been updated'],200);
    }

    public function destroy($source_code){
        $enrollment_bonus = EnrollmentBonusModel::find($source_code);
        
        if(!$enrollment_bonus){
            return response()->json(['message'=>'There is not any data associated with this source code','code'=>404],404);
        }       

       
        $enrollment_bonus->delete();
        return response()->json(['message'=>'Enrollment Bonus is deleted successfully'],200);
    }
}
