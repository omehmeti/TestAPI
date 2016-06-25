<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GetMemberAwardRequest;
use DB;

class MemberAwardsController extends Controller
{
    public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    	/*$member_award = Cache::remember('member_award',864000,function(){
            return MemberAwardsModel::all();
        });

    	
        return response() -> json( ['data' => $member_award],200);
        */
    }

    public function store( CreateMemberAwardRequest $request ){
    	$values = $request->all();

    	$values['claim_date'] = Carbon::createFromFormat('d/m/Y', $request->claim_date);
    	$values['issue_date'] = Carbon::createFromFormat('d/m/Y', $request->issue_date);
    	$values['invoiced_date'] = Carbon::createFromFormat('d/m/Y', $request->invoiced_date);
    	 
    	MemberAwardsModel::create($values);

    	return response()->json(['message'=>'New member award is added successfully'],201);
    }

    public function show($member_award_seq_id){

    	$member_award = MemberAwardsModel::find($member_award_seq_id);
        
    	if(!$member_award){
    		return response()->json(['message'=>'There is not any data associated with this member award seq id','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$member_award],200);
    	}
    	
    }

    public function get_member_award( GetMemberAwardRequest $request){
    	
    	$user_id = $request->user_id;
    	$partner_code = $request->partner_code;
    	$member_award_seq_id = $request->member_award_seq_id;
    	$member_award = '';
    	

    	if($member_award_seq_id){
    		$member_award = DB::table('member_awards')
                    ->where('member_award_seq_id', '=', $member_award_seq_id)
                    ->get();
        }else
    	if($user_id){
    		$member_award = DB::table('member_awards')
                    ->where('user_id', '=', $user_id)
                    ->simplePaginate(5);
        }else
    	if($partner_code){
    		$member_award = DB::table('member_awards')
                    ->where('partner_code', '=', $partner_code)
                    ->simplePaginate(5);
        }

    	
    	if(!$member_award){
    		return response()->json(['message'=>'Please provide correct member_award_seq_id or partner_code or user_id to get member awards','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$member_award],200);
    	}
    	
    }

    public function update(CreateMemberAwarddRequest $request,$code){
    	$member_award = MemberAwardsModel::find($code);
        
        if(!$member_award){
            return response()->json(['message'=>'There is not any data associated with this member_award code','code'=>404],404);
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

      
      	isset($code) ? $member_award->code = $code : '';
		isset($name) ? $member_award->name = $name : '';
		isset($type) ? $member_award->type = $type : '';
		isset($start_date) ? $member_award->start_date = $start_date : '';
		isset($end_date) ? $member_award->end_date = $end_date : '';
		isset($address) ? $member_award->address = $address : '';
		isset($zip_code) ? $member_award->zip_code = $zip_code : '';
		isset($city ) ? $member_award->city = $city : '';
		isset($country_code ) ? $member_award->country_code = $country_code : '';
		isset($email ) ? $member_award->email = $email : '';
		isset($contact_name) ? $member_award->contact_name = $contact_name : '';
		isset($contact_surname) ? $member_award->contact_surname = $contact_surname : '';
		isset($contact_phone) ? $member_award->contact_phone = $contact_phone : '';
		isset($business_number) ? $member_award->business_number = $business_number : '';
		isset($fiscal_number) ? $member_award->fiscal_number = $fiscal_number : '';
		isset($vat_number) ? $member_award->vat_number = $vat_number : '';
		isset($communication_language) ? $member_award->communication_language = $communication_language : '';
		isset($status_active ) ? $member_award->status_active = $status_active : '';
		isset($invoice_type) ? $member_award->invoice_type = $invoice_type : '';
		isset($invoice_date) ? $member_award->invoice_date = $invoice_date : '';

        $member_award->save();
        return response()->json(['message'=>'member_award has been updated'],200);
    }

    public function destroy($member_award_seq_id){
        $member_award = MemberAwardsModel::find($member_award_seq_id);
        
        if(!$member_award){
            return response()->json(['message'=>'There is not any data associated with this member award seq id','code'=>404],404);
        }       

       
        $member_award->status = 'CX';
        $member_award->save();
        return response()->json(['message'=>'Member Award is deleted successfully'],200);
    }



}
