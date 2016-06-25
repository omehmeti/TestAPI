<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMemberAwardRequest extends Request
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
            'user_id' =>'required|numeric|exists:users,id',
            'award_code' => 'required|alpha|max:20',
            'definition' => 'required|string|max:150', 
            'partner_code' => 'required|max:20|exists:partner,code',
            'partner_activity_classification_code' => 'required|max:50|exists:partner_activity_classification,code',
            'partner_branch_code' => 'required|max:50|exists:partner,code',
            'points' => 'required|numeric', 
            'status' => 'required|max:2', 
            'claim_date' => 'required|date_format:d/m/Y',
            'issue_date' => 'date_format:d/m/Y',
            'issuing_user_id' =>'numeric',
            'valid_until' => 'date_format:d/m/Y',
            'issue_count' => 'numeric', 
            'number_of_days' => 'numeric', 
            'redeposited_points' => 'numeric', 
            'cancel_reason_code' => 'numeric|max:3', 
            'invoiced' => 'in:T,F',
            'invoiced_date' => 'date_format:d/m/Y',
            'promotion_code' => 'max:30|alpha'


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
