<?php namespace App\Http\Controllers;

class MyController extends Controller
{
	public function __construct(){
		$this->middleware('auth.basic',['except'=>['index','show']]);
	}
	
	public function index($name = 'user')
	{
		return view('hi',['name' => $name]);
	}
}				