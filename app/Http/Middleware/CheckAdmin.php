<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('sanctum');
        if ($user && $user->role==1) {
            return Response()->json(
                [
                    'message' => 'Forbidden',
                    'errors' => [
                        'access' => "Forbidden. You must be an administrator."
                    ]
                ], 403
            );
        }
        return $next($request);
    }
}
