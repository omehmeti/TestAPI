<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'country';

    public $incrementing = false;
    
	protected $primaryKey = 'country_code';

	protected $fillable = ['country_code','country_name','currency_code','population','fips_code','iso_numeric','north','south','east','west','capital','continent_name','continent','area_in_sq_km','languages','iso_alpha3','geoname_id'];

	protected $hidden = ['updated_at','created_at'];
}