<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
