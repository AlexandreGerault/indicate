<?php

use Illuminate\Database\Seeder;

class NeedCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('company_need_categories')->insert(
            [
                ['name' => 'Finance'],
                ['name' => 'Clientèle'],
                ['name' => 'Communication'],
                ['name' => 'Produit']
            ]);
    }
}
