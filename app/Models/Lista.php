<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'usuario',
        'descricao',
        'observacao',
        'senha',
        'data_criacao',
        'data_conclusao',
    ];
}
