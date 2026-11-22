<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Only the aii voice agent (holding AII_AGENT_TOKEN) may call the agent API. */
class VerifyAgentToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = (string) config('aii.agent_token');
        $given = (string) $request->bearerToken();

        if ($expected === '' || ! hash_equals($expected, $given)) {
            return response()->json(['message' => 'Unauthorised'], 401);
        }

        return $next($request);
    }
}
