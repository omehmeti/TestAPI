<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_cards', function (Blueprint $table) {
            $table->increments('seq_id');
            $table->unsignedInteger('user_id');
            $table->double('balance', 10, 2);
            $table->double('total_points_since_enrollment', 10, 2);
            $table->double('total_points_spent', 10, 2);
            $table->date('issue_date');
            $table->date('expire_date');
            $table->foreign('user_id')->references('id')->on('users');
           
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
        Schema::drop('mebmber_cards_model');
    }
}
