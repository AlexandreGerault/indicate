<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consulting_skill_categories')->insert(
            [
                ['name' => 'Stratégie'],
                ['name' => 'Finance'],
                ['name' => 'Technologie']
            ]);
    }
}
