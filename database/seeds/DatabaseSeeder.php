<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
use App\Vehicle;
use App\User;

use App\Models\CountryModel;
use App\Models\EnrollmentBonusModel;
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
    	Maker::truncate();
    	Vehicle::truncate();
        CountryModel::truncate();
        EnrollmentBonusModel::truncate();
        UserDataModel::truncate();
        User::truncate();
        DB::table('oauth_clients')->truncate();
    	
        Maker::unguard();
    	Vehicle::unguard();
        User::unguard();
                
        $this->call('MakerSeed');
        $this->call('VehiclesSeed');
        $this->call('CountrySeed');
        $this->call('EnrollmentBonusSeed');
        //$this->call('UserDataSeed');
        $this->call('UsersSeed');
        $this->call('OAuthClientSeed');
        
    }
}
