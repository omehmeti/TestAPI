<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    protected $table = 'partner';

    public $incrementing = false;

	protected $primaryKey = 'code';

	protected $fillable = ['code','name','type','start_date','end_date','address','zip_code','city','country_code','email','contact_name','contact_surname','contact_phone','business_number','fiscal_number','vat_number','communication_language','status_active','invoice_type','invoice_date','currency_code'];

	protected $hidden = ['created_at','updated_at'];
	
}
