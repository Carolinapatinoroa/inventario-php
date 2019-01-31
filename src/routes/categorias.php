<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/categorias', function (Request $request, Response $response, array $args) {
     // Sample log message
    $body = $response->getBody();
    
    $rows = Categoria::all();
    
    $body->write(json_encode($rows));
    return $response;
});

