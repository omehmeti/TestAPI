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
            $table->increments('id');
            $table->string('name',50);
            $table->string('surname',50);
            $table->date('birthdate');
            $table->string('email',100);
            $table->enum('gender',['M','F','O']); // M-Male F-Female O-Other
            $table->date('start_date');
            $table->string('status',50);
            $table->string('communication_language',3);
            $table->string('nationality',3);
            $table->string('source_code',30);
            $table->string('referring_member_id',12);
            $table->enum('member_type',['IN','CH','CO'])->default('IN'); // IN-Individual, CH-Charity, CO-Company
            $table->string('nick_name',25);
            $table->enum('consent_email',['T','F']);
            $table->enum('consent_sms',['T','F']);
            $table->string('place_of_birth',50);
            $table->enum('marital_status',['single', 'in_a_relationship','engaged','married','it_is_complicated','long_distance','widowed','separated','divorced'])->default('single');
            $table->date('marriage_date',50);
            
            
            
            
            
            
            
            
            
            
            
            


            //['user_id','name','surname','birthday','gender','nationality','email','phone_number','address','city','country','refere_code','enrollment_source_code'];
           // $table->index('grant_id');
            //$table->index('scope_id');

            //$table->foreign('grant_id')
              //  ->references('id')->on('oauth_grants')
                //->onDelete('cascade');

            //$table->foreign('scope_id')
              //  ->references('id')->on('oauth_scopes')
                //->onDelete('cascade');
            
            // $table->enum('owner_type', ['client', 'user'])->default('user');
            //$table->integer('maker_id')->unsigned();
            //$table->foreign('maker_id')->references('id')->on('makers');

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
        Schema::drop('user_data');
    }
}
