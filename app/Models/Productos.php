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
        'descripcion',	
        'precio',	
        'imagen',	
        'cantidad',
        'id_cateogria',	
        'id_productor'];
    public $timestamps = false;
}
