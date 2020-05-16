<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Company\Comment;
use App\Models\Company\Diagnostic;
use App\Models\Company\Need;
use App\Models\Company\NeedCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CompanyDiagnosticsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_store_diagnostic()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $needs = factory(Need::class, 3)->create();
        $categoryId = $needs[1]->category_id;
        $comments = factory(Comment::class)->raw(['category_id' => $categoryId]);

        $attributes = factory(Diagnostic::class)
            ->raw([
                'needs' => array_map(fn($x) => $x['id'], $needs->toArray())
            ]);

        $args = array_merge(['comment-' . $categoryId => $comments['content']], $attributes);

        $this->post(route('company.diagnostics.store'), $args);
        $this->get(route('company.diagnostics.create'))->assertOk();

        $this->assertDatabaseHas('company_diagnostics', ['user_id' => $user->id]);
        $this->assertDatabaseHas('company_comments', $comments);
    }

    /** @test */
    public function a_user_can_update_a_diagnostic()
    {
        $user = $this->signIn();
        $needs = factory(Need::class, 2)->create();

        $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id]);
        $attributes = factory(Diagnostic::class)->raw(['needs' => $needs->pluck('id')->toArray()]);

        $this->patch($diagnostic->path(), $attributes)
            ->assertRedirect($diagnostic->path());
        $this->get($diagnostic->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('company_diagnostics', ['id' => $diagnostic->id]);
        $this->assertEquals($needs->pluck('id'), $diagnostic->needs->pluck('id'));
    }

    /** @test */
    public function a_user_can_view_a_diagnostic()
    {
        $user = $this->signIn();

        $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id]);

        $this->get($diagnostic->path())->assertOk()->assertSee('diagnostic');
    }

    /** @test */
    public function a_user_can_view_its_diagnostics_list()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        factory(Diagnostic::class, 6)->create(['user_id' => $user->id]);

        $this->get(route('company.diagnostics.index'))
            ->assertOk()
            ->assertSee('diagnostic');
    }

    /** @test */
    public function a_user_must_own_a_diagnostic_to_update_it()
    {
        $this->signIn();

        $diagnostic = factory(Diagnostic::class)->create();
        $attributes = factory(Diagnostic::class)->raw();

        $this->patch($diagnostic->path(), $attributes)->assertStatus(403);
    }

    /** @test */
    public function a_diagnostic_requires_needs()
    {
        $user = $this->signIn();

        $attributes = factory(Diagnostic::class)->raw(['user_id' => $user->id, 'needs' => []]);

        $this->post(route('company.diagnostics.store'), $attributes)->assertSessionHasErrors('needs');
        $this->patch(route('company.diagnostics.update',
            array_merge(
                ['diagnostic' => $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id])->id],
                $attributes
            )))
            ->assertSessionHasErrors('needs');
    }

    /** @test */
    public function a_guest_cannot_manage_diagnostics()
    {
        $diagnostic = factory(Diagnostic::class)->create();

        $this->post(route('company.diagnostics.store'))->assertStatus(302);
        $this->get(route('company.diagnostics.show', compact('diagnostic')))->assertStatus(302);
        $this->patch(route('company.diagnostics.update', compact('diagnostic')))->assertStatus(302);
        $this->get(route('company.diagnostics.edit', compact('diagnostic')))->assertStatus(302);
    }

    /** @test
     *
     *  - Store the diagnostic in the session
     *  - When registered/logged store it to the database
     */
    public function a_guest_can_create_a_diagnostic()
    {
        $user = factory(User::class)->create();

        $needs = factory(Need::class, 3)->create();
        $attributes = factory(Diagnostic::class)
            ->raw([
                'user_id' => null,
                'needs' => array_map(fn($x) => $x['id'], $needs->toArray()),
                'comments' => array()
            ]);

        $this->get(route('company.diagnostics.create'))->assertOk();
        $this->post(route('company.diagnostics.store', $attributes))->assertRedirect(route('login'));

        $this->assertEquals($attributes, Session::get('pending_company_diagnostic'));

        $this->actingAs($user)->post(route('company.diagnostics.store'), Session::get('pending_company_diagnostic'));
        $this->assertDatabaseHas('company_diagnostics', ['user_id' => $user->id]);
    }

    /** @test
     *
     *  When a guest submit the creation form it stores the input in session. This function test that it is being
     *  persisted when the guest logs in.
     */
    public function it_creates_the_diagnostic_when_user_logs_in()
    {
        $credentials = [
            'email' => 'test@test.tld',
            'password' => Hash::make('pass')
        ];
        $user = factory(User::class)->create($credentials);

        $needs = factory(Need::class, 3)->create();
        $attributes = factory(Diagnostic::class)
            ->raw([
                'user_id' => null,
                'needs' => array_map(fn($x) => $x['id'], $needs->toArray())
            ]);

        $this->get(route('company.diagnostics.create'))->assertOk();
        $this->post(route('company.diagnostics.store', $attributes))->assertRedirect(route('login'));
        $this->post(route('login'), $credentials);
        $this->actingAs($user)->get(route('landing_page'));

        $this->assertDatabaseHas('company_diagnostics', ['user_id' => $user->id]);
        $this->assertFalse(Session::has('pending_company_diagnostic'));
    }

    /** @test */
    public function a_user_can_have_diagnostics()
    {
        $user = $this->signIn();
        factory(Diagnostic::class, 5)->create(['user_id' => $user->id]);

        $this->assertCount(5, $user->diagnostics);
    }

    /** @test */
    public function a_user_must_own_a_diagnostic_to_view_it()
    {
        $this->signIn();
        $diagnostic = factory(Diagnostic::class)->create(['user_id' => factory(User::class)]);

        $this->get(route('company.diagnostics.show', compact('diagnostic')))->assertStatus(403);
    }

    /** @test
     *  When the diagnostic is created, no company should be attached
     */
    public function no_company_when_created()
    {
        $user = $this->signIn();
        $diagnostic = factory(Diagnostic::class)->create(['user_id' => $user->id]);

        $this->assertNull($diagnostic->company);
    }

    /** @test
     *
     *  A company can be associated to the diagnostic
     */
    public function it_can_associate_an_existing_company()
    {
        $user = $this->signIn();

        $diagnostic = factory(Diagnostic::class)->create();
        $company = factory(Company::class)->create();

        $this->actingAs($user)
            ->post($diagnostic->path() . '/company/set', ['company_id' => $company->id])
            ->assertRedirect($diagnostic->path());

        $diagnostic = $diagnostic->refresh();

        $this->assertEquals($company->id, $diagnostic->company->id);
    }

    /** @test
     *
     *  A guest shouldn't be able to attach a company to the diagnostic
     */
    public function guest_should_not_be_able_to_attach_a_company()
    {
        $diagnostic = factory(Diagnostic::class)->create();
        $company = factory(Company::class)->create();

        $this->post($diagnostic->path() . '/company/set', ['company_id' => $company->id])
            ->assertRedirect(route('login'));
    }

    /** @test
     *
     *  This test checks that a user has a link to create a company if no company is linked to the diagnostic.
     *  Because no company is associated to the user in this test, it doesn't show the select company action.
     */
    public function it_has_company_creation_action_when_no_company_associated()
    {
        $diagnostic = factory(Diagnostic::class)->create();

        $this->actingAs($diagnostic->user)
            ->get($diagnostic->path())
            ->assertOk()
            ->assertSee(route('companies.create'));
    }

    /** @test
     *
     *  When no company is linked to the diagnostic BUT user has at least one company, it should show two actions:
     *  - Select a company the auth user already has ;
     *  - Create a new company.
     */
    public function it_has_company_actions_when_no_company_associated()
    {
        $diagnostic = factory(Diagnostic::class)->create();
        $companies = factory(Company::class, 3)->create();

        $diagnostic->user->companies()->attach($companies);

        $this->actingAs($diagnostic->user)
            ->get($diagnostic->path())
            ->assertOk()
            ->assertSee(route('companies.create'))
            ->assertSee(route('company.diagnostics.set-company', ['diagnostic' => $diagnostic]));
    }

    /** @test
     *
     *  Comments can be added to each needs category
     */
    public function it_can_have_comments()
    {
        $diagnostic = factory(Diagnostic::class)->create();
        $category = factory(NeedCategory::class)->create();
        $comment = factory(Comment::class)->create([
            'diagnostic_id' => $diagnostic->id,
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('company_comments', $comment->attributesToArray());
        $this->assertInstanceOf(NeedCategory::class, $comment->category);
        $this->assertInstanceOf(Diagnostic::class, $comment->diagnostic);
    }
}
