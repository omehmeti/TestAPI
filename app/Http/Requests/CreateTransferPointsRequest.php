<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTransferPointsRequest extends Request
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
            'from_user_id' =>'required|numeric|exists:users,id',
            'from_name_surname' =>'required|max:50',
            'to_user_id' => 'required|numeric|exists:users,id',
            'to_name_surname' => 'required|max:50',
            'amount' => 'required|numeric', 
            'note' => 'max:200', 
            'operation_date' => 'required|date_format:d/m/Y', 
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
