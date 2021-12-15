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
            $table->bigIncrements('id');
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->string('phone',11);
            $table->boolean('role')->default(0);
            $table->integer('dd')->nullable();
            $table->integer('mm')->nullable();
            $table->integer('yy')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
     // insert Admin at start
     DB::table('users')->insert(
        array(
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin'),
            'first_name'=>'admin',
            'last_name'=>'admin',
            'role'=>1,
            'phone'=>'01061286091',
            'email_verified_at'=>  date('Y-m-d h:i:s ', time()), // to pass from verification
        )
     );
     //----------------------------
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
