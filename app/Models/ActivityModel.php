<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    protected $table = 'activity';

	protected $primaryKey = 'activity_seq_id';

	protected $fillable = ['user_id','activity_type','activity_date','partner_code','partner_activity_classification_code','points','definition','status','sales_values','currency_code','expire_processed','expire_date','adjustment_code','user_name','is_transferred','used_all','used_points','sales_agent_id','rule_code'];

	protected $hidden = ['updated_at','created_at'];
}