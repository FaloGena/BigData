<?php

namespace App\Http\Middleware;

use App\Traits\SavingRequests;
use Closure;
use Illuminate\Http\Request;

class SaveRequest
{
    use SavingRequests;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $savedRequest = $this->startRequest($request);

        $request->request->add(['savedRequest_id' => $savedRequest->id]);

        return $next($request);
    }
}
