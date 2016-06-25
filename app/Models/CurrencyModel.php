<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyModel extends Model
{
    protected $table = 'currency';

    public $incrementing = false;
    
	protected $primaryKey = 'currency_code';

	protected $fillable = ['currency_code','currency_name'];

	protected $hidden = ['updated_at','created_at'];
}