<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_member',255);
            $table->string('id_upline',255);
            $table->string('username')->nullable();
            $table->string('nama');
            $table->string('nomer_hp',12);
            $table->string('rekening',255);
            $table->string('alamat',255);
            $table->string('foto',255);
            $table->string('password',255);
            $table->string('token',255);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
