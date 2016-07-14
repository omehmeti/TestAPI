<?php

namespace App\Admin\Interfaces;
use App\Http\Requests\UpdateMemberBalanceRequest;

Interface GeneralFunctionsInterface
{

    public static function get_member_balance( $user_id );

    public static function update_member_balance( $request );
}