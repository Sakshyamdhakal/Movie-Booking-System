<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovieBooking;

class MovieBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieBooking::factory()->count(10)->create();
    }
}
