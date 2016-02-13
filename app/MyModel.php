<?php namespace app;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
	protected $fillable = ['name','phone','secretAttribute','password'];

	protected $hidden = ['secretAttribute','password'];
}