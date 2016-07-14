<?php

namespace App\Admin\GeneralFunctions;

use App\Admin\Interfaces\GeneralFunctionsInterface;
use App\Http\Requests\UpdateMemberBalanceRequest;
use DB;
class GeneralFunctions implements GeneralFunctionsInterface
{

    public static function get_member_balance($user_id){
    	$balance = DB::table('member_cards')->where('user_id', $user_id)->value('balance');
    	return $balance;
    }
    public static function update_member_balance( $request ){
    	

    	$member_card = DB::table('member_cards')
                    ->where('user_id', '=', $request['user_id'])
                    ->first();

        if(!$member_card){
            return 'There is not any data associated with this user id in member balances';
        }

      
        if($request['operation_type'] == '+' ) {
        	DB::table('member_cards')
            ->where('user_id', $request['user_id'])
            ->update(['balance' => $member_card->balance + $request['amount'], 
                      'total_points_since_enrollment' => $member_card->total_points_since_enrollment + $request['amount']]);
        }else{
        	//if operation_type equals to '-'' then
        	if( $request['amount'] > $member_card->balance) {
        		return response()->json(['message'=>'The points to reedem can not be lower than balance.','code'=>404],404);
        	}else{
        		DB::table('member_cards')
                    ->where('user_id', $request['user_id'])
                    ->update(['balance' => $member_card->balance - $request['amount'], 
                      'total_points_spent' => $member_card->total_points_spent - $request['amount']]);                
        	}
        }

       
        return 'OK';
    }

}

