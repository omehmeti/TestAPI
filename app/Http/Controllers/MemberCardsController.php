<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateMemberBalanceRequest;
use App\Models\MemberCardsModel;
use DB;


class MemberCardsController extends Controller
{
    public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    }

    public function store(){
        return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    	/*$values = $request->all();
    	$values['activity_date'] = Carbon::createFromFormat('d/m/Y', $request->activity_date);
    	$values['expire_date'] = Carbon::createFromFormat('d/m/Y', $request->expire_date);
    	 
    	ActivityModel::create($values);

    	return response()->json(['message'=>'New activity is added successfully'],201);
    	*/
    }

    public function show($user_id){

    	$member_balance = MemberCardsModel::find($user_id);
        
    	if(!$member_balance){
    		return response()->json(['message'=>'There is not any data associated with this user_id','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$member_balance],200);
    	}
    	
    }

    

    public function update(){
	     return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    }

    public function destroy(){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
      
    }
}
