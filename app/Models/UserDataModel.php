<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDataModel extends Model
{
    protected $table = 'UserData';

	protected $primaryKey = 'id';

	protected $fillable = ['user_id','name','surname','birthday','gender','nationality','email','phone_number','address','city','country','refere_code','enrollment_source_code'];

	protected $hidden = ['id','created_at','updated_at','user_id'];
	
	public function user(){
		return $this->belongsTo('App\User');
	}
}
