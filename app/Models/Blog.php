<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $blog = 'blog';
    protected $primaryKey = 'id_blog';
    protected $fillable = ['titulo', 'contenido', 'id_usuario',	'fecha_pub', 'multimedia'];
    public $timestamps = false;

    // En Blog.php
    public function user()
    {
        return $this->belongsTo(User::class, 'id_productor');
    }

}

