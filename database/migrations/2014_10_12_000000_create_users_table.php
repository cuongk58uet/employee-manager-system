<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('email', 255)->unique();
            $table->string('firstname', 255)->default('Guest');
            $table->string('lastname', 255)->default('Account');
            $table->string('gender', 10)->default('Men');
            $table->string('avatar', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address', 255)->nullable();
            $table->boolean('first_login')->default(true);
            $table->boolean('is_reset_password')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->softDeletes();
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
