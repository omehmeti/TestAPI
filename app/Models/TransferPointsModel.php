<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferPointsModel extends Model
{
    protected $table = 'transfer_points';

    public $incrementing = true;
    
	protected $primaryKey = 'seq_id';

	protected $fillable = ['from_user_id','from_name_surname','to_user_id','to_name_surname','amount','note','operation_date'];

	protected $hidden = ['seq_id','updated_at','created_at'];
}
