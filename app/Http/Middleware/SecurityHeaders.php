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
        $isDev = app()->environment('local', 'development');
        $viteOrigin = '';
        $viteWs = '';

        if ($isDev) {
            $hotFile = public_path('hot');
            $viteBase = file_exists($hotFile)
                ? rtrim(file_get_contents($hotFile))
                : 'http://localhost:5173';

            $parsed   = parse_url($viteBase);
            $host     = $parsed['host'] ?? 'localhost';
            $port     = $parsed['port'] ?? 5173;
            $viteOrigin = "http://{$host}:{$port}";
            $viteWs     = "ws://{$host}:{$port}";
        }

        $scriptSrc = $isDev
            ? "script-src 'self' 'unsafe-eval' {$viteOrigin}"
            : "script-src 'self' 'unsafe-eval'";

        $styleSrc = $isDev
            ? "style-src 'self' 'unsafe-inline' {$viteOrigin}"
            : "style-src 'self' 'unsafe-inline'";

        $connectSrc = $isDev
            ? "connect-src 'self' {$viteOrigin} {$viteWs}"
            : "connect-src 'self'";

        $directives = [
            "default-src 'self'",
            $scriptSrc,
            $styleSrc,
            "font-src 'self' data:",
            "img-src 'self' data: blob: https://images.unsplash.com https://plus.unsplash.com",
            $connectSrc,
            "frame-ancestors 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "object-src 'none'",
        ];

        return implode('; ', $directives);
    }
}
