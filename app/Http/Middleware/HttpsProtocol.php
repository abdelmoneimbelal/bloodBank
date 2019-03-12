<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
             if (!$request->secure() && in_array(env('APP_ENV'), ['stage', 'production'])) {
            return redirect()->secure($request->getRequestUri());
        }

            return $next($request); 
    }
}
