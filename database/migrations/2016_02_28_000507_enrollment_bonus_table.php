<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnrollmentBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_bonus', function (Blueprint $table) {
            $table->string('source_code',20)->primary();
            $table->string('name',50);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reference_code',20);
            $table->integer('bonus_points')->unsigned()->default('0');;
            $table->integer('referer_bonus_points')->unsigned()->default('0');
            
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
        Schema::drop('enrollment_bonus');
    }
}
