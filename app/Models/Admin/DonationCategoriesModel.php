<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DonationCategoriesModel extends Model
{
    protected $table = 'donation_categories';

    public $incrementing = true;
    
	protected $primaryKey = 'seq_id';

	protected $fillable = ['donation_category','is_active'];

	protected $hidden = ['updated_at','created_at'];
}
