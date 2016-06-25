<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
use App\Models\UserDataModel;
use App\Models\MemberCardsModel;
use Faker\Factory as Faker;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $faker = Faker::create();
        
        for( $i = 0; $i < 5; $i++ ){

            $user_id = User::Create([
                'email' => $faker->email,
                'username' => $faker->userName,
                'password' => Hash::make('pasword'),
                'phone_number' => $faker->randomNumber(8),
            ]);

            UserDataModel::create ([ 
            'user_id' => $user_id->id,
            'name' => $faker->name,
            'surname' => $faker->lastName, 
            'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'), 
            'gender' => array_rand(['M','F','O']), 
            'start_date' =>  $faker->dateTimeThisCentury->format('Y-m-d'), 
            'status' => array_rand(['AC','CX','DL']), 
            'communication_language' => 'en', 
            'nationality' => array_rand(['ALB','TUR','ENG']), 
            'address' => $faker->streetName .' '. $faker->streetAddress  ,
            'city' => $faker->city,
            'country_code' => 'XS',
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
            
            $temp_points = $faker->randomNumber(4);
            $current_date = Carbon::now()->format('Y-m-d');
            
            MemberCardsModel::Create([
                'user_id' => $user_id->id,
                'balance' => $temp_points - 150,
                'total_points_since_enrollment' => $temp_points,
                'total_points_spent' => -150,
                'issue_date' => $current_date,
                'expire_date' => Carbon::now()->addYears(3)->format('Y-m-d') 
            ]);
        }    
    }
}
