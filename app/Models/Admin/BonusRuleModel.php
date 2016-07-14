<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BonusRuleModel extends Model
{
    protected $table = 'bonus_rule';

    public $incrementing = true;

	protected $primaryKey = 'bonus_seq_id';

	protected $fillable = ['bonus_explanation','partner_code','partner_activity_classification_code','partner_branch_code','type','start_date','end_date','dayofweek','booking_start_date','booking_end_date','member_segment_seq','main_child','status_active','points','add_point','mul_point','max_point','min_point','is_in_promotion','promotion'];

	protected $hidden = ['created_at','updated_at'];
	
}