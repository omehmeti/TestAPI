<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GetActivityRequest extends Request
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
            'activity_seq_id' => 'exists:activity,activity_seq_id',
            'user_id' =>'numeric|exists:users,id',
            'partner_code' => 'max:20|exists:partner,code',
            'partner_activity_classification_code' => 'max:50|exists:partner_activity_classification,code'
            

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
