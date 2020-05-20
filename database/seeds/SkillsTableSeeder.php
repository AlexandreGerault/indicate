<?php

use App\Models\Consulting\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consulting_skills')->insert(
            [
                [
                    'name' => 'Stratégie d\'entreprise',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Logistique',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Management',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Communication',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Marketing',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Ventes',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'M&A',
                    'category_id' => SkillCategory::where('name', 'Stratégie')->first()->id
                ],
                [
                    'name' => 'Comptabilité / Fiscalité',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Gestion financière',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Levée de fonds',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Business plan',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Audit',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Private equity',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Pilotage de la performance',
                    'category_id' => SkillCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Data',
                    'category_id' => SkillCategory::where('name', 'Technologie')->first()->id
                ],
                [
                    'name' => 'Système d\'information',
                    'category_id' => SkillCategory::where('name', 'Technologie')->first()->id
                ],
                [
                    'name' => 'Cybersécurité',
                    'category_id' => SkillCategory::where('name', 'Technologie')->first()->id
                ],

            ]
        );
    }
}
