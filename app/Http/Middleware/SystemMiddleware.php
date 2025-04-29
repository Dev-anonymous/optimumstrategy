<?php

namespace App\Http\Middleware;

use App\Models\Taux;
use Closure;
use Illuminate\Http\Request;

class SystemMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $taux = Taux::first();
        if (!$taux) {
            $taux = Taux::create(['cdf_usd' => 0.00037, 'usd_cdf' => 2690]);
        }
        completeTrans();
        return $next($request);
    }
}
