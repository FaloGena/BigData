<?php

namespace App\Http\Middleware;

use App\Traits\SavingRequests;
use Closure;
use Illuminate\Http\Request;

class UpdateRequestBeforeResponse
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
        $response = $next($request);

        $savedRequest = \App\Models\Request::find($request['savedRequest_id']);
        $this->endRequest($savedRequest, $response->getStatusCode());

        unset($request['savedRequest_id']);

        return $response;
    }
}
