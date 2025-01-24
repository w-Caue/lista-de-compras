<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaItem extends Model
{
    protected $table = 'listas_itens';

    protected $fillable = [
        'lista_id',
        'produto_id',
        'desconto',
        'valor',
        'quantidade',
        'total',
    ];
}
