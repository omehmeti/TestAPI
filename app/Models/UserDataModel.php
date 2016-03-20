<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDataModel extends Model
{
    protected $table = 'user_data';

    public $incrementing = false;

	protected $primaryKey = 'user_id';

	protected $fillable = ['user_id','name','surname','birthdate','start_date','gender','nationality','phone_number','address','city','country_code','referer_code','enrollment_source_code','referring_member_id','place_of_birth','communication_language','status','nick_name'];

	protected $hidden = ['created_at','updated_at'];
	
	public function user(){
		return $this->belongsTo('App\User');
	}
}
