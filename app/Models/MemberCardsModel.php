<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCardsModel extends Model
{
    protected $table = 'member_cards';

	protected $primaryKey = 'seq_id';

	protected $fillable = ['user_id','balance','total_points_since_enrollment','total_points_spent','issue_date','expire_date'];

	protected $hidden = ['seq_id','updated_at','created_at'];
}

  