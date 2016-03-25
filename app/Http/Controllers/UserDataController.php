<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests
use app\Http\Controllers;
use App\User;
use App\Models\UserDataModel;
use Carbon\Carbon;
use Mail;

class UserDataController extends Controller
{
    public function __construct(){
       $this->middleware('oauth',['except'=>['store']]);
    }

    //TO DO: // Create the function
    public function index(){
    	$users = Cache::remember('user',60,function(){
            return User::simplePaginate(15);
        });

        return response() -> json( ['data' => $users],200);
    }

    public function store(CreateUserRequest $request){
        
        DB::transaction(function($request) use ($request)
        {

            $users = User::create([
                                'email'=> $request->email,
                                'username' => $request->username,
                                'password' => HASH::make($request->password)   
                                ]); 
            
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
                                'marital_status' => $request->marital_status,
                                'referring_member_id' => $request->referring_member_id,
                                'nick_name'=>$request->nick_name
                                ]); 
            
        });
       
        return response()->json(['message'=>"Account has been create successfully. Please login now."],201);
    }

    public function show($user_id){
    	$user = UserDataModel::find($user_id);
        if(!$user){
            return response()->json(['message'=>'There is not any data associated with this User ID','code'=>404],404);
        }else{
            
            return response()->json(['data'=> $user],200); //this brings all vehicles associated with Makers :)
        }
    }

    public function update(CreateUserRequest $request, $user_id){
    	
        $user = UserDataModel::find($user_id);
        
        if(!$user){
            return response()->json(['message'=>'There is not any data associated with this User ID','code'=>404],404);
        }  


        $name= $request->name;
        $surname= $request->surname; 
        $birthdate=  Carbon::createFromFormat('d/m/Y', $request->birthdate );                            
        $gender= $request->gender;
        $start_date= Carbon::createFromFormat('d/m/Y',$request->start_date);  
        $status= $request->status; 
        $communication_language= $request->communication_language; 
        $nationality= $request->nationality; 
        $address= $request->address;
        $city= $request->city;
        $country_code= $request->country_code;
        $enrollment_source_code= $request->enrollment_source_code; 
        $referring_member_id= $request->referring_member_id; 
        $member_type= $request->member_type; //IN: Individual; CO: Company or Corporate; CH: Charity or NGO  
        $consent_email= $request->consent_email; // T: True; F: False 
        $consent_sms= $request->consent_sms; // T: True; F: False 
        $place_of_birth= $request->place_of_birth;
        $marital_status= $request->marital_status;
        $referring_member_id= $request->referring_member_id;
        $nick_name=$request->nick_name;
        

        isset( $name ) ? $user->name = $name : '';
        isset( $surname ) ? $user->surname = $surname : '';
        isset( $birthdate ) ? $user->birthdate = $birthdate : '';
        isset( $gender ) ? $user->gender = $gender : '';
        isset( $start_date ) ? $user->start_date = $start_date : '';
        isset( $status ) ? $user->status = $status : '';
        isset( $communication_language ) ? $user->communication_language = $communication_language : '';
        isset( $nationality ) ? $user->nationality = $nationality : '';
        isset( $address ) ? $user->address = $address : '';
        isset( $city ) ? $user->city = $city : '';
        isset( $country_code ) ? $user->country_code = $country_code : '';
        isset( $enrollment_source_code ) ? $user->enrollment_source_code = $enrollment_source_code : '';
        isset( $referring_member_id ) ? $user->referring_member_id = $referring_member_id : '';
        isset( $member_type ) ? $user->member_type = $member_type : '';
        isset( $consent_email ) ? $user->consent_email = $consent_email : '';
        isset( $consent_sms ) ? $user->consent_sms = $consent_sms : '';
        isset( $place_of_birth ) ? $user->place_of_birth = $place_of_birth : '';
        isset( $marital_status ) ? $user->marital_status = $marital_status : '';
        isset( $referring_member_id ) ? $user->referring_member_id = $referring_member_id : '';
        isset( $nick_name ) ? $user->nick_name = $nick_name : '';

        $user->save();
        return response()->json(['message'=>'User has been updated'],200);

    }

    public function destroy(DeleteUserRequest $request, $user_id){
    	

        $user = UserDataModel::find($user_id);
        
        if(!$user){
            return response()->json(['message'=>'There is not any data associated with this user ID','code'=>404],404);
        }
        $status = $request->status;        
        if($status != 'DL' && $status != 'CX' ){
            return response()->json(['message'=>'Your status parameter is wrong. Please verify it.','code'=>404],404);
        }
        $user->status = $status;
        $user->save();

        if ($status == 'DL'){
            return response()->json(['message'=>'User account is deleted successfully'],200);    
        }else{
            return response()->json(['message'=>'User account is closed successfully'],200);
        }
        
    }


    public function reset_password( $input ){
        if( !$input ){
            return response()->json(['message'=>'Email or username can not be empty.','code'=>404],404);
        }

        $field = filter_var($input,FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user ='';
        if( $field == 'email'){
            $user = User::where('email', $input)->first();
        }else{
            $user = User::where('username', $input)->first();
        }

        if( $user ){

            // Generate temporary password
            $password = str_random(10);

            $user->password = Hash::make($password);

            if($user->save()){
            
                // Send email to $user->email with the new $password
                Mail::send('emails.reset_password', ['user' => $user,'password'=>$password], function ($message) use ($user) {
                        $message->from('noreply@pikacard.com', 'Pikacard');

                        $message->to($user->email, $user->username)->subject('Pikacard - Password Reset Email');

                        /*
                        $message->from($address, $name = null);
                        $message->sender($address, $name = null);
                        $message->to($address, $name = null);
                        $message->cc($address, $name = null);
                        $message->bcc($address, $name = null);
                        $message->replyTo($address, $name = null);
                        $message->subject($subject);
                        $message->priority($level);
                        $message->attach($pathToFile, array $options = []);
                        $message->attach($pathToFile, ['as' => $display, 'mime' => $mime]);

                        // Attach a file from a raw $data string...
                        $message->attachData($data, $name, array $options = []);

                        // Get the underlying SwiftMailer message instance...
                        $message->getSwiftMessage();

                        */
                });

                return response()->json(['message'=>'New password is emailed to your email account. Please check your inbox or your junk or spam folder.','code'=>200],200);
            }else{
                return response()->json(['message'=>'There was a problem reseting your password. Please try again or contact our contact center at 080001000.','code'=>404],404);
            }
        }else{
            return response()->json(['message'=>'The username or email that you provided is not registered in our system. Please check and verify it.','code'=>404],404);
        }


    
    }

}
