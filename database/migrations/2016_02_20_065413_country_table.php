<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->string('country_code',2)->primary();
            $table->string('country_name',45);
            $table->string('currency_code',3);
            $table->string('population',20);
            $table->string('fips_code',2);
            $table->string('iso_numeric',4);
            $table->string('north',30);
            $table->string('south',30);
            $table->string('east',30);
            $table->string('west',30);
            $table->string('capital',30);
            $table->string('continent_name',15);
            $table->string('continent',2);
            $table->string('area_in_sq_km',20);
            $table->string('languages',100);
            $table->string('iso_alpha3',3);
            $table->integer('geoname_id');
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
        Schema::drop('country');
    }
}
