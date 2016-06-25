<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PartnerModel;
use App\Http\Requests\CreatePartnerRequest;

class PartnerController extends Controller
{
     public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	$partner = Cache::remember('partner',864000,function(){
            return PartnerModel::all();
        });

    	
        return response() -> json( ['data' => $partner],200);
        
    }

    public function store( CreatePartnerRequest $request ){
    	  $values = $request->all();
    	
    	  PartnerModel::create($values);

    	  return response()->json(['message'=>'New partner is added successfully'],201);
    	
                  /*PartnerModel::create ([ 
            'code'  => $values['code'],
            'name' => $values['name'],
            'type' => $values['type'],
            'start_date'=> Carbon::createFromFormat('d/m/Y', $values['start_date']),
            'end_date' => Carbon::createFromFormat('d/m/Y', $values['end_date']),
            'address' => $values['address'],
            'zip_code' => $values['zip_code'],
            'city'  => $values['city'],
            'country_code'  => $values['country_code'],
            'email'  => $values['email'],
            'contact_name' => $values['contact_name'],
            'contact_surname' => $values['contact_surname'],
            'contact_phone' => $values['contact_phone'],
            'business_number' => $values['business_number'],
            'fiscal_number' => $values['fiscal_number'],
            'vat_number' => $values['vat_number'],
            'communication_language' => $values['communication_language'], 
            'status_active'  => $values['status_active'], 
            'invoice_type' => $values['invoice_type']
           // 'invoice_date' => Carbon::createFromFormat('d/m/Y', $values['invoice_date'])
            ]);
            */
    	
    }

    public function show($code){
    	$partner = PartnerModel::find($code);
    	if(!$partner){
    		return response()->json(['message'=>'There is not any data associated with this Partner code','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$partner],200);
    	}
    	
    }

    public function update(CreatepartnerRequest $request,$code){
    	$partner = PartnerModel::find($code);
        
        if(!$partner){
            return response()->json(['message'=>'There is not any data associated with this Partner code','code'=>404],404);
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

      
      	isset($code) ? $partner->code = $code : '';
		isset($name) ? $partner->name = $name : '';
		isset($type) ? $partner->type = $type : '';
		isset($start_date) ? $partner->start_date = $start_date : '';
		isset($end_date) ? $partner->end_date = $end_date : '';
		isset($address) ? $partner->address = $address : '';
		isset($zip_code) ? $partner->zip_code = $zip_code : '';
		isset($city ) ? $partner->city = $city : '';
		isset($country_code ) ? $partner->country_code = $country_code : '';
		isset($email ) ? $partner->email = $email : '';
		isset($contact_name) ? $partner->contact_name = $contact_name : '';
		isset($contact_surname) ? $partner->contact_surname = $contact_surname : '';
		isset($contact_phone) ? $partner->contact_phone = $contact_phone : '';
		isset($business_number) ? $partner->business_number = $business_number : '';
		isset($fiscal_number) ? $partner->fiscal_number = $fiscal_number : '';
		isset($vat_number) ? $partner->vat_number = $vat_number : '';
		isset($communication_language) ? $partner->communication_language = $communication_language : '';
		isset($status_active ) ? $partner->status_active = $status_active : '';
		isset($invoice_type) ? $partner->invoice_type = $invoice_type : '';
		isset($invoice_date) ? $partner->invoice_date = $invoice_date : '';

        $partner->save();
        return response()->json(['message'=>'Partner has been updated'],200);
    }

    public function destroy($code){
        $partner = PartnerModel::find($code);
        
        if(!$partner){
            return response()->json(['message'=>'There is not any data associated with this Partner code','code'=>404],404);
        }       

       
        $partner->status = 'F';
        $partner->save();
        return response()->json(['message'=>'Partner is deleted successfully'],200);
    }
}
