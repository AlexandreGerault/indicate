<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Company\Comment;
use App\Models\Company\Diagnostic;
use App\Models\Company\Need;
use App\Models\Company\NeedCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyDiagnosticsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_needs()
    {
        $diag = factory(Diagnostic::class)->create();
        $needs = factory(Need::class, 4)->create();
        $diag->addNeeds($needs);

        $this->assertEquals(
            $diag->needs->pluck('id'),
            Need::findMany($needs->pluck('id'))->pluck('id')
        );
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $diagnostic = factory(Diagnostic::class)->create();

        $this->assertInstanceOf(User::class, $diagnostic->user);
    }

    /** @test */
    public function it_has_a_path()
    {
        $diag = factory(Diagnostic::class)->create();

        $this->assertEquals('/company/diagnostics/' . $diag->id, $diag->path());
    }

    /** @test */
    public function it_can_belongs_to_a_company()
    {
        $diag = factory(Diagnostic::class)->create();
        $company = factory(Company::class)->create();

        $diag->company()->associate($diag);
        $diag->save();

        $this->assertEquals($company->id, $diag->company->id);
    }

    /** @test
     *
     *  Find the comment of a given category
     */
    public function it_can_find_a_category_comment()
    {
        $diag = factory(Diagnostic::class)->create();
        $cat = factory(NeedCategory::class)->create();
        $comment = factory(Comment::class)->create(['diagnostic_id' => $diag->id, 'category_id' => $cat->id]);

        $this->assertEquals($comment->id, $diag->commentOfCategory($cat)->id);
    }
}
