<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests
use App\Http\Requests;
use App\Models\ActivityModel;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\GetActivityRequest;
use App\Interfaces\BonusRules\BonusRule;
use DB;

class ActivityController extends Controller
{

    public function __construct(){
		$this->middleware('oauth');
	}

    public function index()
    {   
      
        $bonusRule = new BonusRule();
       
        $boom = $bonusRule->matchBonusRule();

        return $boom;
    }


	/*public function index(){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    	/*$activity = Cache::remember('activity',864000,function(){
            return ActivityModel::all();
        });

    	
        return response() -> json( ['data' => $activity],200);
        */
    /*}*/

    public function store( CreateActivityRequest $request ){
    	$values = $request->all();
    	$values['activity_date'] = Carbon::createFromFormat('d/m/Y', $request->activity_date);
    	$values['expire_date'] = Carbon::createFromFormat('d/m/Y', $request->expire_date);
    	 
    	ActivityModel::create($values);

    	return response()->json(['message'=>'New activity is added successfully'],201);
    }

    public function show($activity_seq_id){

    	$activity = ActivityModel::find($activity_seq_id);
        
    	if(!$activity){
    		return response()->json(['message'=>'There is not any data associated with this activity code','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$activity],200);
    	}
    	
    }

    public function get_activity( GetActivityRequest $request){
    	
    	$user_id = $request->user_id;
    	$partner_code = $request->partner_code;
    	$activity_seq_id = $request->activity_seq_id;
    	$activity = '';
    	

    	if($activity_seq_id){
    		$activity = DB::table('activity')
                    ->where('activity_seq_id', '=', $activity_seq_id)
                    ->get();
        }else
    	if($user_id){
    		$activity = DB::table('activity')
                    ->where('user_id', '=', $user_id)
                    ->simplePaginate(5);
        }else
    	if($partner_code){
    		$activity = DB::table('activity')
                    ->where('partner_code', '=', $partner_code)
                    ->simplePaginate(5);
        }

    	
    	if(!$activity){
    		return response()->json(['message'=>'Please provide correct activity_seq_id or partner_code or user_id to get activities','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$activity],200);
    	}
    	
    }

    public function update(CreateActivityRequest $request,$code){
    	$activity = ActivityModel::find($code);
        
        if(!$activity){
            return response()->json(['message'=>'There is not any data associated with this activity code','code'=>404],404);
        }

		$code  = $request->code;
        $name = $request->name;
        $type = $request->type;
        $start_date= Carbon::createFromFormat('d/m.Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
        $address = $request->address;
        $zip_code = $request->zip_code;
        $city  = $request->city;
        $country_code  = $request->country_code;
        $email  = $request->email;
        $contact_name = $request->contact_name;
        $contact_surname = $request->contact_surname;
        $contact_phone = $request->contact_phone;
        $business_number = $request->business_number;
        $fiscal_number = $request->fiscal_number;
        $vat_number = $request->vat_number;
        $communication_language = $request->communication_language;
        $status_active  = $request->status_active;
        $invoice_type = $request->invoice_type;
        $invoice_date = Carbon::createFromFormat('d/m/Y', $request->invoice_date);

      
      	isset($code) ? $activity->code = $code : '';
		isset($name) ? $activity->name = $name : '';
		isset($type) ? $activity->type = $type : '';
		isset($start_date) ? $activity->start_date = $start_date : '';
		isset($end_date) ? $activity->end_date = $end_date : '';
		isset($address) ? $activity->address = $address : '';
		isset($zip_code) ? $activity->zip_code = $zip_code : '';
		isset($city ) ? $activity->city = $city : '';
		isset($country_code ) ? $activity->country_code = $country_code : '';
		isset($email ) ? $activity->email = $email : '';
		isset($contact_name) ? $activity->contact_name = $contact_name : '';
		isset($contact_surname) ? $activity->contact_surname = $contact_surname : '';
		isset($contact_phone) ? $activity->contact_phone = $contact_phone : '';
		isset($business_number) ? $activity->business_number = $business_number : '';
		isset($fiscal_number) ? $activity->fiscal_number = $fiscal_number : '';
		isset($vat_number) ? $activity->vat_number = $vat_number : '';
		isset($communication_language) ? $activity->communication_language = $communication_language : '';
		isset($status_active ) ? $activity->status_active = $status_active : '';
		isset($invoice_type) ? $activity->invoice_type = $invoice_type : '';
		isset($invoice_date) ? $activity->invoice_date = $invoice_date : '';

        $activity->save();
        return response()->json(['message'=>'activity has been updated'],200);
    }

    public function destroy($activity_act_seq){
        $activity = ActivityModel::find($activity_act_seq);
        
        if(!$activity){
            return response()->json(['message'=>'There is not any data associated with this activity act sequence','code'=>404],404);
        }       

       
        $activity->status = 'F';
        $activity->save();
        return response()->json(['message'=>'activity is deleted successfully'],200);
    }
}
