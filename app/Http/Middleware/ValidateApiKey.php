<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');
        if (!$apiKey) {
            return response()->json(['message' => 'API Key is missing'], 401);
        }

        $validApiKey = ApiKey::where('key', $apiKey)->first();
        if (!$validApiKey) {
            return response()->json(['message' => 'Invalid API Key'], 403);
        }

        return $next($request);
    }
}
