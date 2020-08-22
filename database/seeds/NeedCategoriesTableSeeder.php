<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeedCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_need_categories')->insert(
            [
                ['name' => 'Finance'],
                ['name' => 'Clientèle'],
                ['name' => 'Communication'],
                ['name' => 'Produit']
            ]);
    }
}
