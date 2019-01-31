<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/entradas-inventario', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->post('/entradas-inventario', function (Request $request, Response $response, array $args) {
   $body = $response->getBody();
    
    
    $data = $request->getParsedBody();
    
    $newProducto = new EntradaInventario();
    $newProducto->producto_id= $data['producto_id'];
    $newProducto->cantidad= $data['cantidad'];
    $newProducto->save();
    
    $total = EntradaInventario::where('producto_id', $data['producto_id'])
                                ->selectRaw('SUM(entrada_inventario.cantidad) AS total')
                                ->first()
                                ->total;
    
     $producto = Producto::find( $data['producto_id']);
     $producto->cantidad = $total;
     $producto->save();

    // Render index view
    $body->write(json_encode([
        'message'=>"Se ha registrado el ingreso del producto"
    ]));
    return $response;
});