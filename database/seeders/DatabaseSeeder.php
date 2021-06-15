<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Repositories\Models\User::factory()->create();
        \App\Repositories\Models\Package::factory(10)->create();
        \App\Repositories\Models\Status::factory(5)->create();
        \App\Repositories\Models\PackageStatus::factory(25)->create();
    }
}
