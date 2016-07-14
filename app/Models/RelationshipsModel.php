<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationshipsModel extends Model
{
     protected $table = 'relationships';

    public $incrementing = true;
    
	protected $primaryKey = 'seq_id';

	protected $fillable = ['from_user_id','to_user_id','relationship_type','create_date','end_date','ended_by_user_id'];

	protected $hidden = ['updated_at','created_at'];
}
