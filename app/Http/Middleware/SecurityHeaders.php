<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Previene MIME-sniffing en el navegador
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Anti-clickjacking (duplicado en frame-ancestors del CSP)
        $response->headers->set('X-Frame-Options', 'DENY');

        // Oculta la tecnología del servidor
        $response->headers->remove('X-Powered-By');
        header_remove('X-Powered-By');

        // Referrer solo en same-origin para no filtrar URLs internas
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        $response->headers->set('Content-Security-Policy', $this->buildCsp());

        return $response;
    }

    private function buildCsp(): string
    {
        $directives = [
            "default-src 'self'",

            // Alpine.js v3 usa Function() constructor → requiere unsafe-eval.
            // En dev también permite el HMR websocket de Vite.
            app()->environment('local', 'development')
                ? "script-src 'self' 'unsafe-eval' http://localhost:5173 http://[::1]:5173 ws://localhost:5173 ws://[::1]:5173"
                : "script-src 'self' 'unsafe-eval'",

            // Tailwind + posibles estilos inline de Alpine
            "style-src 'self' 'unsafe-inline'",

            // Fuentes auto-hospedadas vía fontsource (no Google Fonts CDN)
            "font-src 'self' data:",

            // Imágenes: logos y avatars subidos por usuarios
            "img-src 'self' data: blob:",

            // Fetch / Axios solo al propio origen
            "connect-src 'self'",

            // Bloquea iframes por completo (reemplaza X-Frame-Options)
            "frame-ancestors 'none'",

            // Evita inyección de base href
            "base-uri 'self'",

            // Forms solo al propio origen
            "form-action 'self'",

            // Bloquea Flash/plugins
            "object-src 'none'",
        ];

        return implode('; ', $directives);
    }
}
