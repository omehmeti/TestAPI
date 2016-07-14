<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrganizationsAndClubs extends Model
{
    protected $table = 'organizations_and_clubs';

    public $incrementing = true;
    
	protected $primaryKey = 'seq_id';

	protected $fillable = ['name','picture','short_description','long_description','donation_category','is_active','start_date','end_date','bank_name','branch','address','account_no_iban','account_currency','beneficary_bank_swift_code','IBAN','account_holder_name_surname','total_points_donated','number_of_donations'];

	protected $hidden = ['updated_at','created_at'];
}
