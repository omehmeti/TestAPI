<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguagesModel extends Model
{
    protected $table = 'languages';

    public $incrementing = false;
    
	protected $primaryKey = 'code';

	protected $fillable = ['code','language'];

	protected $hidden = ['updated_at','created_at'];
}
