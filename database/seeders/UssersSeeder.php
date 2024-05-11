<?php

namespace Database\Seeders;

use App\Models\Ussers;
use Illuminate\Database\Seeder;

class UssersSeeder extends Seeder
{
    public function run()
    {
        Ussers::factory()->count(10)->create();
    }
}
