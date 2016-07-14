<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransferPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_points', function (Blueprint $table) {
            $table->increments('seq_id');
            $table->unsignedInteger('from_user_id');
            $table->string('from_name_surname',50);
            $table->unsignedInteger('to_user_id');
            $table->string('to_name_surname',50);
            $table->double('amount', 10, 2);
            $table->string('note',200);
            $table->date('operation_date');
            $table->timestamps();
            
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transfer_points');
    }
}
