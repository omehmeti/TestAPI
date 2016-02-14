<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
use App\Vehicle;
use App\User;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::Create([
                'email'=>'test@hotmail.com',
                'password'=>Hash::make('pasword')
            ]);
    }
}
