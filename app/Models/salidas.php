<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salidas extends Model
{
    use HasFactory;
    protected $table = 'salidas';
    protected $primaryKey = 'id_salida';
    protected $fillable = ['id_producto','cantidad','tipo_salida','fecha_salida'];
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}