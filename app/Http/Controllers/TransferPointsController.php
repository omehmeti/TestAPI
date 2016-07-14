<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferPointsModel;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Requests\CreateTransferPointsRequest;
use App\Http\Requests\UpdateMemberBalanceRequest;
use App\Admin\GeneralFunctions\GeneralFunctions;
use DB;
class TransferPointsController extends Controller
{
        public function __construct(){
		$this->middleware('oauth');
	}

	public function index(){
    	return response()->json(['message'=>'You can not perform this action','code'=>404],404);
    }

    public function store(CreateTransferPointsRequest $request){
        // Check if members balance is enough for transfer amount
	   	$balance = GeneralFunctions::get_member_balance($request->from_user_id);
    	if( $balance >= $request->amount) {
    		$values = $request->all();
    		$values['operation_date'] = Carbon::createFromFormat('d/m/Y', $request->operation_date);
    		TransferPointsModel::create($values);

            $from_member_balance_array = array('user_id' => $request->from_user_id, 'amount'=> $request->amount, 'operation_type' => '-');
            $to_member_balance_array = array('user_id' => $request->to_user_id, 'amount'=> $request->amount, 'operation_type' => '+');
            
            $from_message = GeneralFunctions::update_member_balance($from_member_balance_array);
            $to_message = GeneralFunctions::update_member_balance($to_member_balance_array);
            if ($from_message != 'OK' && $to_message != 'OK' ) {
                if($from_message != 'OK'){
                    return response()->json(['message'=>$from_message,'code'=>404],404);
                }else {
                    return response()->json(['message'=>$to_message,'code'=>404],404);
                }
                
            }
            else{
    		  return response()->json(['message'=> 'Transfer of points is successfully done.'],201);
            }  

    	}else{
    		return response()->json(['message'=>'You dont have enough balance to transfer this amount. Your current balance is: ' . $balance . ' .Please select an amount lower or equal to your balance.','code'=>404],404);
    	}
    	

    	
    	
    }

    public function show($user_id){
 
    	$transfer_points = DB::table('transfer_points')
                    ->where('from_user_id', '=', $user_id)
                    ->orWhere(function($query)use ($user_id) { $query->where('to_user_id', '=', $user_id); })
                    ->paginate(10);
        
    	if(!$transfer_points){
    		return response()->json(['message'=>'There is not any transfer associated with this user_id','code'=>404],404);
    	}else{
    		return response()->json(['data'=>$transfer_points],200);
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
