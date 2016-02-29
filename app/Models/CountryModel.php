<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'country';

    public $incrementing = false;
    
	protected $primaryKey = 'code';

	protected $fillable = ['code','name','test'];

	protected $hidden = ['updated_at','created_at'];
}
