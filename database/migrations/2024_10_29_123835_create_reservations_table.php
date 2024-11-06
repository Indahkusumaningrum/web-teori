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
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id')->nullable()->change();
            $table->string('reservation_name');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('guest_count');
            $table->enum('status', ['pending', 'confirmed',
            'cancelled'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('userrest')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
