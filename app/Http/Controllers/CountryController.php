<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use App\Http\Requests\CreateCountryRequest;

class CountryController extends Controller
{
    public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	$countries = Cache::remember('Country',60,function(){
            return CountryModel::all();
        });

    	
        return response() -> json( ['data' => $countries],200);
        
    }

    public function store( CreateCountryRequest $request ){
    	  $values = $request->only(['code','name']);
    	
    	  CountryModel::create($values);
    	  return response()->json(['message'=>'New country is added successfully'],201);
    	
    	
    }

    public function show($country_code){
    	$countries = CountryModel::find($country_code);
    	if(!$countries){
    		return response()->json(['message'=>'There is not any data associated with this country code','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$countries],200);
    	}
    	
    }

    public function update(CreateCountryRequest $request,$country_code){
    	$country = CountryModel::find($country_code);
        
        if(!$country){
            return response()->json(['message'=>'There is not any data associated with this country code','code'=>404],404);
        }

        $code = $request->get('code');
        $name = $request->get('name');

        $country->code = $code;
        $country->name = $name;
        $country->save();
        return response()->json(['message'=>'Country has been updated'],200);
    }
}
