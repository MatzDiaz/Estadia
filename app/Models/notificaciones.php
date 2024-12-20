<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notificaciones extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';
    protected $primaryKey = 'id_notifica';
    protected $fillable = [
        'id_notifica',
        'id_usua',
        'mensaje',
        'fecha',
        ];
    public $timestamps = false;
}
