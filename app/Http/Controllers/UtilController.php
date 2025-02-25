<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use App\Models\ListaItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function visualizarPedido(Request $request)
    {
        $codigo = $request->codigo;

        $itens = ListaItem::select([
            'listas_itens.*',
            'produtos.id as produto_codigo',
            'produtos.nome',
            'produtos.marca',
            'produtos.descricao',
            'produtos.quantidade as quantidade_pedida',
        ])
            ->leftjoin('produtos', 'produtos.id', '=', 'listas_itens.produto_id')
            ->where('listas_itens.lista_id', $codigo)
            ->get();

        $total = 0;
        foreach ($itens as $item) {
            if ($item->faltando == 'N') {
                $total += $item->total;
            }
        }
        $totalLista = $total;

        $lista = Lista::where('id', $codigo)->first();

        $pdf = Pdf::loadView('pages.pdf', ['itens' => $itens, 'total' => $totalLista, 'lista' => $lista]);

        return $pdf->stream('arquivo.pdf');
    }
}
