<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartnerBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_branch', function (Blueprint $table) {
            $table->string('code',50)->primary();
            $table->string('name',100);
            $table->string('partner_code',20);
            $table->string('address',20);
            $table->string('latitude',20);
            $table->string('longitude',20);
            $table->string('open_hours',50);
            $table->string('open_days',50);
            $table->string('contact_info',100);
            $table->string('status_active',1);

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
        Schema::drop('partner_branch');
    }
}
