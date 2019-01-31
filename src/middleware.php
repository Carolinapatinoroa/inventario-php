<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
/**
 * mostramos las preferencias de cabeceras (headers)
 */
$app->add(function ($request, $response, $next) {
    if ($request->getUri()->getPath() !== '/') {
        $response = $response
                ->withHeader("content-type", "application/json; charset=utf-8")
                ->withHeader("Access-Control-Allow-Origin","*")
                ->withHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS, PATCH")
                ->withHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Range, Content-Match, Content-Type, Access-Token, Token-Due")
                ->withHeader("Access-Control-Allow-Credentials", true);
    }
    return $next($request, $response);
});