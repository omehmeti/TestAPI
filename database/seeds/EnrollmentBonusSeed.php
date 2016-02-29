<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\EnrollmentBonusModel;
use Faker\Factory as Faker;


class EnrollmentBonusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        EnrollmentBonusModel::create ([ 
            'source_code' =>  'ANDROID_APP', 
            'name' => 'Android Application',
            'start_date' => $faker->dateTimeBetween('-10 days', '+0 days') ,
            'end_date' => $faker->dateTimeBetween('+365 days', '+2 years'),
            'bonus_points' => '100',
            'referer_bonus_points' => '50'
        ]);

        EnrollmentBonusModel::create ([ 
            'source_code' =>  'IOS_APP', 
            'name' => 'IOS Application',
            'start_date' => $faker->dateTimeBetween('-10 days', '+0 days') ,
            'end_date' => $faker->dateTimeBetween('+365 days', '+2 years'),
            'bonus_points' => '200',
            'referer_bonus_points' => '100'
        ]);
        
        
    }
}
