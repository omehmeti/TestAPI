<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerBranchModel extends Model
{
    protected $table = 'partner_branch';

    public $incrementing = false;

	protected $primaryKey = 'code';

	protected $fillable = ['code','name','partner_code','address','latitude','longitude','status_active','open_hours','open_days','contact_info'];

	protected $hidden = ['created_at','updated_at'];
	
}  