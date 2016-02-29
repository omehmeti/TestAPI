<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentBonusModel extends Model
{
    protected $table = 'enrollment_bonus';

    public $incrementing = false;
    
	protected $primaryKey = 'source_code';

	protected $fillable = ['source_code','name','start_date','end_date','reference_code','bonus_points','referer_bonus_points'];

	protected $hidden = ['start_date','end_date','reference_code','bonus_points','referer_bonus_points','updated_at','created_at'];
}
