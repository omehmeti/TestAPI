<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\PartnerModel;
use App\Models\PartnerActivityClassificationModel;
use Faker\Factory as Faker;


class PartnerSeed extends Seeder
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
            $temp_company_code = $faker->company . $i;

            PartnerModel::create ([ 
                'code'  => $temp_company_code,
                'name' => $faker->company,
                'type' => array_rand(['FURNITURE','HOTEL','CAR_RENTAL','TELECOM']),
                'start_date' => $faker->dateTimeBetween('-10 days', '+0 days') ,
                'end_date' => $faker->dateTimeBetween('+365 days', '+2 years'),
                'address' =>$faker->address,
                'zip_code' =>$faker->postcode,
                'city'  =>$faker->city,
                'country_code'  => 'XS',//$faker->countryCode,
                'email'  =>$faker->companyEmail,
                'contact_name' => $faker->name,
                'contact_surname' => $faker->lastName,
                'contact_phone' => $faker->phoneNumber,
                'business_number' => $faker->randomNumber(8),
                'fiscal_number' => $faker->randomNumber(8),
                'vat_number' => $faker->randomNumber(8),
                'communication_language' => 'en', 
                'status_active'  => array_rand(['T','F']), 
                'invoice_type' => array_rand(['W','TW','M']),
                'invoice_date' => $faker->dateTime(),
            ]);

            PartnerActivityClassificationModel::create ([ 
                'code'  => 'ISTIKBAL'.$i,
                'name' => 'ISTIKBAL'.$i,
                'partner_code'  => $temp_company_code,
                'expiration_days'  => 365,
                'status_active' => 'T'
            ]);

       }
        
        
    }
}
