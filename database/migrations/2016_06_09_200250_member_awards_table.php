<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_awards', function (Blueprint $table) {
            $table->increments('member_award_seq_id');
            $table->unsignedInteger('user_id');
            $table->string('award_code',20);
            $table->string('definition',150);
            $table->string('partner_code',20);
            $table->string('partner_activity_classification_code',50);
            $table->string('partner_branch_code',50);

            $table->double('points', 10, 2);
            $table->string('status',2);
            $table->date('claim_date');
            $table->date('issue_date');
            $table->integer('issuing_user_id');
            $table->date('valid_until');
            $table->integer('issue_count');
            $table->integer('number_of_days');
            $table->integer('cancel_reason_code');
            $table->double('redeposited_points', 10, 2);
            $table->enum('invoiced',['T','F'])->default('F');
            $table->date('invoiced_date');
            $table->string('promotion_code',30);
            $table->string('rule_code',10);

            //Foreign Key controlls
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('partner_code')->references('code')->on('partner');
            $table->foreign('partner_activity_classification_code')->references('code')->on('partner_activity_classification');

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
        Schema::drop('member_awards');
    }
}