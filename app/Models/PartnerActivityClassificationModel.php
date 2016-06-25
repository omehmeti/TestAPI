<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerActivityClassificationModel extends Model
{
    protected $table = 'partner_activity_classification';

    //public $incrementing = true;

	protected $primaryKey = 'seq_id';

	protected $fillable = ['code','name','partner_code','expiration_days','status_active'];

	protected $hidden = ['created_at','updated_at'];
	
}  