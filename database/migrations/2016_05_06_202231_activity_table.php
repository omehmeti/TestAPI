<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('activity_seq_id');
            $table->unsignedInteger('user_id');
            $table->string('activity_type',20);
            $table->date('activity_date');
            $table->string('partner_code',20);
            $table->string('partner_activity_classification_code',50);
            $table->double('points', 10, 2);
            $table->string('definition',150);
            $table->string('status',2);
            $table->string('reference',50);
            $table->enum('expire_processed',['T','F'])->default('F');
            $table->date('expire_date');
            $table->double('sales_values', 10, 2);
            $table->string('currency_code',3);
            $table->string('adjustment_code',20);
            $table->enum('is_transfered',['T','F'])->default('F');
            $table->enum('used_all',['T','F'])->default('F');
            $table->double('used_points',10,2);
            $table->string('sales_agent_id',20);
            $table->string('rule_code',10);
        
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('partner_code')->references('code')->on('partner');
            $table->foreign('partner_activity_classification_code')->references('code')->on('partner_activity_classification');
            $table->foreign('currency_code')->references('currency_code')->on('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity');
    }
}
