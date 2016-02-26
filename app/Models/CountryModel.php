<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
     protected $table = 'Country';

	protected $primaryKey = 'code';

	protected $fillable = ['code','name'];

	protected $hidden = ['created_at','updated_at'];
}
