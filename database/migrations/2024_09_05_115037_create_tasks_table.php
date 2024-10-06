<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('task_address');
            $table->datetime('start_time');
            $table->string('task_phone');
            $table->string('works');
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->datetime('cancele')->nullable();
            $table->enum('group' , ['group1','group2']);
            $table->enum('status' , [ 'waiting' ,'ongoing' , 'completed' , 'canceled'])->default('waiting');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
