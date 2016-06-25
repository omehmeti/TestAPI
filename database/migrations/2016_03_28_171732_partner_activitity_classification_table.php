<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartnerActivitityClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_activity_classification', function (Blueprint $table) {
            $table->increments('seq_id');
            $table->string('code',50);
            $table->string('name',100);
            $table->string('partner_code',20);
            $table->integer('expiration_days');
            $table->enum('status_active',['T','F'])->default('F');;
            $table->timestamps();

            $table->foreign('partner_code')->references('code')->on('partner');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partner_activity_classification');
    }
}