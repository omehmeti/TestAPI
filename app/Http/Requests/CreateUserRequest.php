<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required|alpha|max:50',
            'surname' => 'required|alpha|max:50', 
            'birthdate' => 'required|date_format:d/m/Y', 
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|max:60', 
            'gender' => 'required|in:M,F,O|max:1', 
            'start_date' =>  'required|date_format:d/m/Y', 
            'status' => 'required|in:AC,CX,DL', 
            'communication_language' => 'required', 
            'nationality' => 'in:ALB,TUR,ENG', 
            'address' => 'max:255',
            'city' => 'required|alpha|max:50',
            'country_code' => 'required|max:2|exists:country,code',
            'enrollment_source_code' => 'required|max:20|exists:enrollment_bonus,source_code', 
            'referring_member_id' => 'max:50', 
            'member_type' => 'in:IN,CO,CH', //IN: Individual, CO: Company or Corporate, CH: Charity or NGO  
            'username' => 'unique:users,username', 
            'consent_email' => 'in:T,F', // T: True, F: False 
            'consent_sms' => 'in:T,F', // T: True, F: False 
            'place_of_birth' => 'alpha',
            'marital_status' => 'in:single,in_a_relationship,engaged,married,it_is_complicated,long_distance,widowed,separated,divorced'



        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return response()->json(['message'=> $errors,'code'=>422],422);
    }
}
