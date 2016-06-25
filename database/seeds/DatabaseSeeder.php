<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
use App\Vehicle;
use App\User;

use App\Models\CurrencyModel;
use App\Models\CountryModel;
use App\Models\EnrollmentBonusModel;
use App\Models\PartnerModel;
use App\Models\LanguagesModel;
use App\Models\UserDataModel;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');//this disables foreign key for truncate
    	//Maker::truncate();
    	//Vehicle::truncate();
        CurrencyModel::truncate();
        CountryModel::truncate();
        EnrollmentBonusModel::truncate();
        PartnerModel::truncate();
        LanguagesModel::truncate();
        User::truncate();
        UserDataModel::truncate();
       
        DB::table('oauth_clients')->truncate();
    	
        //Maker::unguard();
    	//Vehicle::unguard();
        User::unguard();
                
        //$this->call('MakerSeed');
        $this->call('CurrencySeed');
        $this->call('CountrySeed');
        $this->call('EnrollmentBonusSeed');
        $this->call('PartnerSeed');
        $this->call('LanguagesSeed');
        //$this->call('UserDataSeed');
        $this->call('UsersSeed');
        $this->call('OAuthClientSeed');
        
    }
}
