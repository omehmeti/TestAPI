<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserDataModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string('name',50);
            $table->string('surname',50);
            $table->date('birthdate');
            $table->enum('gender',['M','F','O']); // M-Male F-Female O-Other
            $table->date('start_date');
            $table->string('status',2);
            $table->string('communication_language',3);
            $table->string('nationality',3);
            $table->string('address');
            $table->string('city',3);
            $table->string('country_code',2);
            $table->string('enrollment_source_code',20);
            $table->string('referring_member_id',50);
            $table->enum('member_type',['IN','CH','CO'])->default('IN'); // IN-Individual, CH-Charity, CO-Company
            $table->string('nick_name',25);
            $table->enum('consent_email',['T','F']);
            $table->enum('consent_sms',['T','F']);
            $table->string('place_of_birth',50);
            $table->enum('marital_status',['single', 'in_a_relationship','engaged','married','it_is_complicated','long_distance','widowed','separated','divorced'])->default('single');
            $table->date('marriage_date',50);
            $table->timestamps();
            

            // Create Indexes           
            $table->index('name');
            $table->index('surname');
            
            
            //Forign key contraints
            $table->foreign('country_code')->references('country_code')->on('country');
            $table->foreign('enrollment_source_code')->references('source_code')->on('enrollment_bonus');
            $table->foreign('communication_language')->references('code')->on('languages');
            


            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_data');
    }
}
