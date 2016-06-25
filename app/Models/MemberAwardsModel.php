<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAwardsModel extends Model
{
    protected $table = 'member_awards';

	protected $primaryKey = 'member_award_seq_id';

	protected $fillable = ['user_id','award_code','definition','partner_code','partner_activity_classification_code','partner_branch_code','points','definition','rule_code','status','claim_date','issue_date','issuing_user_id','valid_until','issue_count','number_of_days','redeposited_points','cancel_reason_code','invoiced','invoiced_date','promotion_code'];

	protected $hidden = ['updated_at','created_at'];
}