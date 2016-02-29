<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDataModel;
use Faker\Factory as Faker;


class UserDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for( $i = 0; $i < 10; $i++ ){
        UserDataModel::create ([ 
            'name' => $faker->name,
            'surname' => $faker->lastName, 
            'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'), 
            'email' => $faker->email, 
            'gender' => array_rand(['M','F','O']), 
            'start_date' =>  $faker->dateTimeThisCentury->format('Y-m-d'), 
            'status' => array_rand(['AC','CX','DL']), 
            'communication_language' => array_rand(['ALB','TUR','ENG']), 
            'nationality' => array_rand(['ALB','TUR','ENG']), 
            'address' => $faker->streetName .' '. $faker->streetAddress  ,
            'city' => $faker->city,
            'enrollment_source_code' => 'ANDROID_APP', 
           // 'referring_member_id' => XXXXXXX, 
            'member_type' => 'IN', 
            'nick_name' => $faker->userName, 
            'consent_email' => 'T', 
            'consent_sms' => 'T', 
            'place_of_birth' => $faker->city, 
            //'marital_status' => XXXXXXX, 
            //'marriage_date' => XXXXXXX         
           
        ]);

       }
        
        
    }
}
