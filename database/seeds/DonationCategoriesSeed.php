<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DonationCategoriesModel;


class DonationCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DonationCategoriesModel::create ([ 'donation_category' => 'Select Category','is_active' => 'T']);
        DonationCategoriesModel::create ([ 'donation_category' => 'English','is_active' => 'T']);        
        DonationCategoriesModel::create ([ 'donation_category' => 'Educational','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Humanitarian','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Sport Club','is_active' => 'T']);
        DonationCategoriesModel::create ([ 'donation_category' => 'Veterinarian/Animal care','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Arts in the community','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Community health','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Environmental','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Individual/group support in time of need','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Local emergency/disaster','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Shelter and food programs','is_active' => 'T']);          
        DonationCategoriesModel::create ([ 'donation_category' => 'Youth programs','is_active' => 'T']);          
       
    }
}
