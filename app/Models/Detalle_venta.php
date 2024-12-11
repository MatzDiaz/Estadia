<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    use HasFactory;
    protected $table = 'detalles_venta';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_venta',
        'cantidad',
        'total'
    ];
}
