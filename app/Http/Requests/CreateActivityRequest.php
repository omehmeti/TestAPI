<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateActivityRequest extends Request
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
            'activity_type' => 'alpha|max:20', 
            'activity_date' => 'required|date_format:d/m/Y', 
            'partner_code' => 'required|max:20|exists:partner,code',
            'partner_activity_classification_code' => 'required|max:50|exists:partner_activity_classification,code',
            'points' => 'required|numeric', 
            'definition' => 'required|string|max:150', 
            'status' => 'required|max:2', 
            'reference' => 'alpha|max:50', 
            'expire_processed' => 'in:T,F|max:1',
            'expire_date' => 'required|date_format:d/m/Y',
            'sales_values' => 'required|numeric',
            'currency_code' => 'required|max:3|alpha', 
            'adjustment_code' => 'max:20|alpha', 
            'is_transfered' => 'in:T,F', 
            'used_all' => 'in:T,F|max:1', 
            'used_points' => 'numeric', 
            'sales_agent_id' => 'alpha|max:20', 
            'rule_code' => 'alpha|max:10'

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
