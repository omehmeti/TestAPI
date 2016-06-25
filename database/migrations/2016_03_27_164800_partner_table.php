<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner', function (Blueprint $table) {
            $table->string('code',20)->primary();
            $table->string('name',100);
            $table->string('type',20);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('address',150);
            $table->string('zip_code',10);
            $table->string('city',3);
            $table->string('country_code',2);
            $table->string('email',150);
            $table->string('contact_name',50);
            $table->string('contact_surname',50);
            $table->string('contact_phone',50);
            $table->string('business_number',50);
            $table->string('fiscal_number',50);
            $table->string('vat_number',50);
            $table->string('communication_language',2)->default('EN');
            $table->enum('status_active',['T','F'])->default('F'); // T-True, F-False
            $table->enum('invoice_type',['W','TW','M'])->default('M'); // W-Weekly, TW-Two Weeks, M-Monthly
            $table->string('invoice_date',10);
            $table->timestamps();

            //Forign key contraints
            $table->foreign('country_code')->references('country_code')->on('country');
            $table->foreign('communication_language')->references('code')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partner');
    }
}

