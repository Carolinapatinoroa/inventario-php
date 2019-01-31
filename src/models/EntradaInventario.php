<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\Model;

/**
 * Description of EntradaInventario
 *
 * @author Mario
 */
class EntradaInventario extends Model {
    //put your code here
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entrada_inventario';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad','producto_id'];
}
