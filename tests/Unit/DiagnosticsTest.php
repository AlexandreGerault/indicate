<?php

namespace Tests\Unit;

use \App\Diagnostic;
use \App\Need;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiagnosticsTest extends TestCase
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

        $this->assertEquals('/diagnostics/' . $diag->id, $diag->path());
    }
}
