<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePartnerRequest extends Request
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
            'code' => 'required|max:20|unique:partner,code',
            'name' => 'required|max:100',
            'type' => 'required|max:20',
            'start_date' => 'required|date_format:d/m/Y', 
            'end_date' => 'required|date_format:d/m/Y', 
            'address' => 'required|max:150',
            'zip_code' => 'required|max:10',
            'city' => 'required|max:3',
            'country_code' => 'required|exists:country,code',
            'email' => 'email|max:150',
            'contact_name' => 'required|max:50',
            'contact_surname' => 'required|max:50',
            'contact_phone' => 'required|max:50',
            'business_number' => 'required|max:50',
            'fiscal_number' => 'required|max:50',
            'vat_number' => 'required|max:50',
            'communication_language' => 'required|exists:languages,code', 
            'status_active' => 'required|in:T,F',
            'invoice_type' => 'required|in:W,TW,M',  
            'invoice_date' => 'date_format:d/m/Y'
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
