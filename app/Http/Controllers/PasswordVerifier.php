<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
class PasswordVerifier extends Controller
{
    public function verify($input, $password)
    {
        $field ='';
        if( filter_var($input, FILTER_VALIDATE_FLOAT) ){
            $field = 'phone_number';
        }else{
    	   $field = filter_var($input,FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    	}
        $credentials = 
    	[
    		$field => $input,
    		'password' => $password,
    	];
    
    if(Auth::once($credentials)){
    	//TODO: Add control for CX and DL statuses so they can not login
        return Auth::user()->id;
    }

    return false;
    
    //Checking if exists user by email or username

    /*$user = User::where('email', $username)->orWhere('username', $username)->first();

    if($user)

    {

        //If exists so check password

        if(Hash::check($password, $user->password))

        {

            //if match, so return the user id.

            return $user->id;

        }

    //If not, so continue to return false

    }


    //If does not exists return false

    return false;*/
    }


}
