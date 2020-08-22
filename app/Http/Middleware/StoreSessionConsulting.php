<?php

namespace App\Http\Middleware;

use App\Models\Consulting;
use App\Models\Consulting\Specification;
use Closure;

class StoreSessionConsulting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() and $request->session()->has('pending_consulting')) {
            $consulting = Consulting::create($request->session()->get('pending_consulting'));

            $specsArray = array_map(
                function ($key, $value) use ($consulting) {
                    preg_match('#category-([0-9]+)$#', $key, $matches);
                    return Specification::make([
                        'category_id' => $value['category_id'],
                        'consulting_id' => (int) $consulting->id,
                        'content' => $value['content']
                    ])->toArray();
                },
                array_keys($request->session()->get('pending_consulting')['specifications']),
                array_values($request->session()->get('pending_consulting')['specifications'])
            );

            $consulting->skills()->attach($request->session()->get('pending_consulting')['skills']);
            $consulting->specifications()->createMany($specsArray);
            auth()->user()->consultings()->attach($consulting);
            $request->session()->forget('pending_consulting');

            return redirect($consulting->path());
        }
        return $next($request);
    }
}
