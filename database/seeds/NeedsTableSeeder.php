<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_needs')->insert(
            [
                [
                    'name' => 'Augmentation des recettes',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Diminution des charges',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Finance')->first()->id
                ],
                [
                    'name' => 'Fidélisation',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Clientèle')->first()->id
                ],
                [
                    'name' => 'Satisfaction client',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Clientèle')->first()->id
                ],
                [
                    'name' => 'Susciter la réaction du client',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Clientèle')->first()->id
                ],
                [
                    'name' => 'RSE',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Communication')->first()->id
                ],
                [
                    'name' => 'Valeur ajoutée',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Produit')->first()->id
                ],
                [
                    'name' => 'Technologie interne',
                    'category_id' => \App\Models\Company\NeedCategory::where('name', 'Produit')->first()->id
                ],

            ]
        );
    }
}
