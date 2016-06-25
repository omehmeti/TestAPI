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

    public function store( CreateActivityRequest $request ){
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

    

    public function update(UpdateMemberBalanceRequest $request){
	    //DB::table('users')->where('votes', '>', 100)->lockForUpdate()->get();	
		$member_card = DB::table('member_cards')
                    ->where('user_id', '=', $request->user_id)
                    ->first();

        if(!$member_card){
            return response()->json(['message'=>'There is not any data associated with this user id in member balances','code'=>404],404);
        }

      
        if( $request->operation_type == '+' ) {
        	
        	DB::table('member_cards')->increment('balance', $request->amount, ['total_points_since_enrollment' => $member_card->total_points_since_enrollment + $request->amount]);
        }else{
        	//if operation_type equals to '-'' then
        	if( $request->amount > $member_card->balance) {
        		return response()->json(['message'=>'The points to reedem can not be lower than balance.','code'=>404],404);
        	}else{
        		DB::table('member_cards')->decrement('balance', $request->amount, ['total_points_spent' => $member_card->total_points_spent - $request->amount]);
        	}
        }

       
        return response()->json(['message'=>'Member balance updated successfully.'],200);
    }

    public function destroy($user_id){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
        /*$activity = ActivityModel::find($activity_act_seq);
        
        if(!$activity){
            return response()->json(['message'=>'There is not any data associated with this activity act sequence','code'=>404],404);
        }       

       
        $activity->status = 'F';
        $activity->save();
        return response()->json(['message'=>'activity is deleted successfully'],200);*/
    }
}
