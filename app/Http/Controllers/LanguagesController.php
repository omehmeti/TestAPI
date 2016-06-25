<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //Added for cache support of requests

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LanguagesModel;
use App\Http\Requests\CreateLanguagesRequest;

class LanguagesController extends Controller
{
    public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	$languages = Cache::remember('languages',999999,function(){
            return LanguagesModel::all();
        });

    	
        return response() -> json( ['data' => $languages],200);
        
    }

    public function store( CreateLanguagesRequest $request ){
    	  $values = $request->all();
    	
    	  //LanguagesModel::create($values);
          LanguagesModel::create ([ 'language' => $values['language'],'code' => $values['code'] ]);
        
    	  return response()->json(['message'=>'New Languages is added successfully'],201);
    	
    	
    }

    public function show($lang_id){
    	$languages = LanguagesModel::find($lang_id);
    	if(!$languages){
    		return response()->json(['message'=>'There is not any data associated with this language id','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$languages],200);
    	}
    	
    }

    public function update(CreateLanguagesRequest $request,$lang_id){
    	$languages = LanguagesModel::find($lang_id);
        
        if(!$languages){
            return response()->json(['message'=>'There is not any data associated with this language id','code'=>404],404);
        }

      

        $language = $request->get('language');
        $code = $request->get('code');
        

        $languages->language = $language;
        $languages->code = $code;
        $languages->save();
        return response()->json(['message'=>'Language has been updated'],200);
    }

    public function destroy($lang_id){
        $languages = LanguagesModel::find($lang_id);
        
        if(!$languages){
            return response()->json(['message'=>'There is not any data associated with this language id','code'=>404],404);
        }       

       
        $languages->delete();
        return response()->json(['message'=>'Language is deleted successfully'],200);
    }
}
