<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/productos', function (Request $request, Response $response, array $args) {
    // Sample log message
    $body = $response->getBody();
    
    $rows = Producto::join('categoria', 'categoria.id', '=', 'producto.categoria_id')
            ->select('producto.*', 'categoria.nombre as categoria_nombre')
            ->get();
    
    $body->write(json_encode($rows));
    return $response;
    
});


$app->post('/productos', function (Request $request, Response $response, array $args) {
    // Sample log message
    $body = $response->getBody();
    
    
    $data = $request->getParsedBody();
    
    $newProducto = new Producto();
    $newProducto->nombre= $data['nombre'];
    $newProducto->categoria_id= $data['categoria_id'];
    $newProducto->cantidad= 0;
    $newProducto->save();

    // Render index view
    $body->write(json_encode([
        'message'=>"Se ha registrado el producto"
    ]));
    return $response;
});


$app->delete('/productos/{id}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $body = $response->getBody();
    
    $entradas = EntradaInventario::where('producto_id',$args['id'])->get();
    
    if(count($entradas) > 0){
        // Render index view
        $body->write(json_encode([
            'message'=>"No se puede eliminar el producto por que ya registra entradas de stock"
        ]));
        return $response->withStatus(400);
    }
    
    $producto = Producto::find($args['id']);
    $producto->delete();
    

    // Render index view
    $body->write(json_encode([
        'message'=>"Se ha registrado el producto"
    ]));
    return $response;
});