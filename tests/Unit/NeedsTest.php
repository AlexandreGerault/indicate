<?php

namespace Tests\Unit;

use App\Models\Company\Need;
use App\Models\Company\NeedCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class NeedsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_change_category()
    {
        $need = factory(Need::class)->create();

        $category = factory(NeedCategory::class)->create();

        $need->category()->associate($category);

        $this->assertEquals($need->category->id, $category->id);
    }
}
