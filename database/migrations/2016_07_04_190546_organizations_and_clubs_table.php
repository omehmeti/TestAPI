<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrganizationsAndClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_and_clubs', function (Blueprint $table) {
            $table->increments('seq_id');
            $table->string('name','50');
            $table->string('short_description','100');
            $table->string('long_description','5000');
            $table->unsignedInteger('donation_category');
            $table->enum('is_active',['T','F'])->default('F');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('bank_name','50');
            $table->string('branch','50');
            $table->string('address','150');
            $table->string('account_no_iban','50');
            $table->string('account_currency','3');
            $table->string('beneficary_bank_swift_code','50');
            $table->string('IBAN','50');
            $table->string('account_holder_name_surname','50');
            $table->double('total_points_donated');
            $table->integer('number_of_donations');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations_and_clubs');
    }
}