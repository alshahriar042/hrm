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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->time('in_time')->nullable();
            $table->string('in_region_name')->nullable();
            $table->string('in_city_name')->nullable();
            $table->string('in_zip_code')->nullable();
            $table->string('in_latitude')->nullable();
            $table->string('in_longitude')->nullable();
            $table->text('in_device_name')->nullable();
            $table->time('out_time')->nullable();
            $table->string('out_region_name')->nullable();
            $table->string('out_city_name')->nullable();
            $table->string('out_zip_code')->nullable();
            $table->string('out_latitude')->nullable();
            $table->string('out_longitude')->nullable();
            $table->text('out_device_name')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
