<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    protected $fillable = [
	    'id_usuario',
    	'id_producto',
    	'cantidad',
        'fecha_agregado',
        'SubTotalPorducto'	
    ];
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto', 'id_producto');
    }
}
