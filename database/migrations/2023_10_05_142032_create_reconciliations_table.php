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
        Schema::create('reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('action_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->date('date')->nullable();
            $table->text('reason')->nullable();
            $table->text('remark')->nullable();
            $table->enum('approval_status',['pending','approved','rejected'])->default('pending');
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
        Schema::dropIfExists('reconciliations');
    }
};
