<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $categorias = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre_cat','descripcion'];
    public $timestamps = false;
 }
