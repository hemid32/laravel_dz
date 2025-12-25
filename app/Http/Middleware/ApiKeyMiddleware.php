<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    use GeneralTrait ; 
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $apiKey = $request->header('X-API-KEY');

        if (! $apiKey || $apiKey !== config('app.api_key')) {
            return  $this->returnError(403 , 'Unauthorized (Invalid API Key)');
        }
        return $next($request);
    }
}
