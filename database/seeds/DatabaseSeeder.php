<?php

use App\CompanyNeed;
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
        $this->call(NeedCategoriesTableSeeder::class);
        $this->call(NeedsTableSeeder::class);
    }
}
