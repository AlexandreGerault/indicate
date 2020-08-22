<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConsultingRequest;
use App\Models\Consulting;
use App\Models\Consulting\Specification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ConsultingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Consulting\SkillCategory::with('skills')->get();

        return view('consultings.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateConsultingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateConsultingRequest $request)
    {
        $consulting = Consulting::make($request->validated());

        $specs = array_filter(
            $request->validated(),
            fn($key) => (preg_match('#^specification-[0-9]+$#', $key) && $request->validated()[$key]),
            ARRAY_FILTER_USE_KEY
        );

        $specsArray = array_map(
            function ($key, $value) use ($consulting) {
                preg_match('#([0-9]+)$#', $key, $matches);
                return Specification::make([
                    'category_id' => (int) ($matches[0]),
                    'consulting_id' => (int) $consulting->id ?? null,
                    'content' => $value
                ])->toArray();
            },
            array_keys($specs),
            array_values($specs)
        );

        if(auth()->guest()) {
            $request->session()->put('pending_consulting', [
                'name' => $request->validated()['name'],
                'responsible' => $request->validated()['responsible'],
                'phone' => $request->validated()['phone'],
                'email' => $request->validated()['email'],
                'skills' => $request->validated()['skills'],
                'specifications' => $specsArray
            ]);

            return redirect()->route('login');
        } else {
            $consulting = Consulting::create($consulting->toArray());
            $consulting->skills()->attach($request->validated()['skills']);
            $consulting->specifications()->createMany($specsArray);
            auth()->user()->consultings()->attach($consulting);

            return redirect($consulting->path());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Consulting $consulting
     * @return Factory|View
     */
    public function show(Consulting $consulting)
    {
        $categories = Consulting\SkillCategory::with(['skills' => function ($q) use ($consulting) {
            $q->whereHas('consultings', function($query) use ($consulting) {
                $query->where('consulting_id', $consulting->id);
            });
        }])->get();
        return view('consultings.show', compact('consulting', 'categories'))->with('consulting', $consulting);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
