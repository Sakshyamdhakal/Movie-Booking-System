<?php

 /**
     * Run the migrations.
     */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('movie_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->integer('seats');
            $table->string('movie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('movie_bookings');
    }
};
