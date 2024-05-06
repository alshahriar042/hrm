<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->foreignId('department_id')->nullable();
            $table->string('name');
            $table->string('emp_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('employee_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(0);
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
};
