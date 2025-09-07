<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Newmovie;

class NewmovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Newmovie::factory()->count(10)->create();
    }
}
