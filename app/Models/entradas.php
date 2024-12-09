<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entradas extends Model
{
    use HasFactory;
    protected $table = 'entradas';
    protected $primaryKey = 'id_entrada';
    protected $fillable = ['id_producto','cantidad','existencia','precio','tipo_entrada','fecha_entrada'];
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
