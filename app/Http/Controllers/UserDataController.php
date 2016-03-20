<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use app\Http\Controllers;
use App\User;
use App\Models\UserDataModel;
use Carbon\Carbon;


class UserDataController extends Controller
{
    public function __construct(){
       $this->middleware('oauth',['except'=>['store']]);
    }

    //TO DO: // Create the function
    public function index($user_id){
    	$users = Users::find($user_id);
        if(!$users){
            return response()->json(['message'=>'There is not any data associated with this user ID','code'=>404],404);
        }else{
            return response()->json(['data'=>$users],200); //this brings all user data associated with user id :)
        }
    }

    public function store(CreateUserRequest $request){
        //return response()->json(['message'=>'TEST: '.date("d/m/Y", strtotime($request->birthdate))],200);
        
        DB::transaction(function($request) use ($request)
        {

            $user_request = $request->only(['email','username','password']);
            $users = User::create([
                                'email'=> $request->email,
                                'username' => $request->username,
                                'password' => HASH::make($request->password)   
                                ]); 
            //DB::table('users')->create();
             //return response()->json(['message'=>"User id =  $users->user_id"],201);

            //$user_data = $request->except(['email','username','password']);
           

            UserDataModel::create ([  'user_id' => $users->id,
                                'name' =>$request->name,
                                'surname' => $request->surname, 
                                'birthdate' =>  Carbon::createFromFormat('d/m/Y', $request->birthdate ),                            
                                'gender' => $request->gender, 
                                'start_date' => Carbon::createFromFormat('d/m/Y',$request->start_date),  
                                'status' => $request->status, 
                                'communication_language' => $request->communication_language, 
                                'nationality' => $request->nationality, 
                                'address' => $request->address,
                                'city' => $request->city,
                                'country_code' => $request->country_code,
                                'enrollment_source_code' => $request->enrollment_source_code, 
                                'referring_member_id' => $request->referring_member_id, 
                                'member_type' => $request->member_type, //IN: Individual, CO: Company or Corporate, CH: Charity or NGO  
                                'consent_email' => $request->consent_email, // T: True, F: False 
                                'consent_sms' => $request->consent_sms, // T: True, F: False 
                                'place_of_birth' => $request->place_of_birth,
                                'referring_member_id' => $request->referring_member_id,
                                'nick_name'=>$request->nick_name
                                ]); 
            //UserDataModel::create($user_data);
            //DB::table('user_data')->delete();
        });
       
        return response()->json(['message'=>"Account has been create successfully. Please login now."],201);
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
