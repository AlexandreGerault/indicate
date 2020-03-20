<?php

namespace Tests\Unit;

use App\CompanyNeed;
use App\CompanyNeedCategory;
use App\Models\Company\Need;
use App\Models\Company\NeedCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NeedCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_category_has_needs()
    {
        $category = factory(NeedCategory::class)->create();
        $needs = factory(Need::class, 2)->create(['category_id' => $category->id]);

        $this->assertEquals($category->needs->pluck('id'), $needs->pluck('id'));
    }
}
