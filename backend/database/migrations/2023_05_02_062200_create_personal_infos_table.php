<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('nrc')->unique();
            $table->date('dob');
            $table->string('phone')->unique();
            $table->longText('address');
            $table->string('city');
            $table->string('country');
            $table->longText('skill');
            $table->enum('marital_status',['Single','Martial','Widowed','Divorced']);
            $table->enum('gender',['Male','Female']);
            $table->string('profession');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE personal_infos ADD profile_pic MEDIUMBLOB NULL AFTER skill");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
};
