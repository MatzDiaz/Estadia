<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre',
        'descripcion',	
        'precio',	
        'imagen',	
        'cantidad',
        'id_cateogria',	
        'id_productor'];
    public $timestamps = false;

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'id_producto', 'id_producto');
    }
    // En el modelo Producto
    public function productor()
    {
        return $this->belongsTo(User::class, 'id_productor');
    }
}
