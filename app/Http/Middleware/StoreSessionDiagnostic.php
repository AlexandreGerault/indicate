<?php

namespace App\Http\Middleware;

use App\Models\Company\Diagnostic;
use Closure;

class StoreSessionDiagnostic
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
        if (auth()->check() and $request->session()->has('pending_company_diagnostic')) {
            $diagnostic = Diagnostic::create([
                'user_id' => auth()->user()->id,
                'uuid' => uniqid()
            ]);
            $diagnostic->addNeeds($request->session()->get('pending_company_diagnostic')['needs']);
            $request->session()->forget('pending_company_diagnostic');

            return redirect($diagnostic->path());
        }
        return $next($request);
    }
}
