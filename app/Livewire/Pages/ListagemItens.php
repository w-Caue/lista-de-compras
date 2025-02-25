<?php

namespace App\Livewire\Pages;

use App\Models\Lista;
use App\Models\ListaItem;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListagemItens extends Component
{
    use LivewireAlert;

    public $sortField = 'id';
    public $sortAsc = false;

    public $listaId;
    public $descricao;

    public $status;

    #PRODUTO
    public $nome;
    public $marca;
    public $desc;
    public $preco;
    public $observacao;
    public $totalProduto;
    public $faltandoProduto;

    #LISTA ITEM
    public $quantidade = 0;
    public $quantidadePedida = 0;

    #TOTAIS
    public $totalLista;
    public $produtosComprados;
    public $produtosFaltando;
    public $quantidadeProduto;

    public $codigoProduto;

    protected $listeners = [
        'delete',
        'faltando',
        'finalizar',
    ];

    public function mount($codigo)
    {
        $this->cabecalho($codigo);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function dados()
    {
        $itens = ListaItem::select([
            'listas_itens.*',
            'produtos.id as produto_codigo',
            'produtos.nome',
            'produtos.marca',
            'produtos.descricao',
            'produtos.quantidade as quantidade_pedida',
        ])
            ->leftjoin('produtos', 'produtos.id', '=', 'listas_itens.produto_id')
            ->where('listas_itens.lista_id', $this->listaId);

        if ($this->sortField == 'quantidade' or $this->sortField == 'nome') {
            $itens = $itens->orderBy($this->sortField, $this->sortAsc ? 'ASC' : 'DESC')->get();
        } else {
            $itens = $itens->orderBy('quantidade', 'ASC')->orderBy('id', 'DESC')->get();
        };

        $total = 0;
        foreach ($itens as $item) {
            if ($item->faltando == 'N') {
                $total += $item->total;
            }
        }
        $this->totalLista = $total;

        return $itens;
    }

    private function cabecalho($codigo)
    {
        $lista = Lista::where('id', $codigo)->first();

        $this->listaId = $lista->id;
        $this->descricao = $lista->descricao;
        $this->status = $lista->status;
    }

    public function adicionarItem($quantidade)
    {
        $this->nome = trim($this->nome);

        $prod = ListaItem::select([
            'listas_itens.*',
            'produtos.id as produto_codigo',
            'produtos.nome',
        ])
            ->leftjoin('produtos', 'produtos.id', '=', 'listas_itens.produto_id')
            ->where('listas_itens.lista_id', $this->listaId)
            ->where('produtos.nome', $this->nome)
            ->first();

        if ($prod != null) {
            return $this->alert('error', 'Item com esse nome já esta na lista!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        $produto = Produto::create([
            'nome' => $this->nome,
            'descricao' => $this->desc,
            'quantidade' => $quantidade,
        ]);

        if ($produto->save()) {
            $listaItem = ListaItem::create([
                'lista_id' => $this->listaId,
                'produto_id' => $produto->id,
            ]);

            if ($listaItem->save()) {
                $this->dispatch('close-modal-small');

                return $this->alert('success', 'Item adicionado!', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        }
    }

    public function produto($codigo)
    {
        if ($codigo == 0) {
            $this->nome = '';
            $this->desc = '';
            return;
        }

        $this->codigoProduto = $codigo;

        $produto = ListaItem::select([
            'listas_itens.*',
            'produtos.id as produto_codigo',
            'produtos.nome',
            'produtos.marca',
            'produtos.descricao',
            'produtos.observacao',
            'produtos.quantidade as quantidade_pedida',
        ])
            ->leftjoin('produtos', 'produtos.id', '=', 'listas_itens.produto_id')
            ->where('listas_itens.lista_id', $this->listaId)
            ->where('produto_id', $this->codigoProduto)
            ->first();

        $this->nome = $produto->nome;
        $this->marca = $produto->marca;
        $this->desc = $produto->descricao;
        $this->preco = number_format($produto->valor, 2, ',');
        $this->totalProduto = $produto->total;
        $this->quantidadeProduto = $produto->quantidade;
        $this->quantidadePedida = $produto->quantidade_pedida;
        $this->faltandoProduto = $produto->faltando;
    }

    public function conferindoItem($quantidade)
    {
        $produto = Produto::where('id', $this->codigoProduto)->update([
            'marca' => $this->marca,
            'descricao' => $this->desc,
            'quantidade' => $this->quantidadePedida,
            'observacao' => $this->observacao,
        ]);

        $produto;
        $this->preco = str_replace(",", ".", $this->preco);

        $item = ListaItem::where('produto_id', $this->codigoProduto)->update([
            'valor' => floatval($this->preco),
            'quantidade' => $quantidade,
            'total' => floatval($this->preco) * $quantidade,
        ]);

        $this->dispatch('close-modal-small');

        $this->alert('success', 'Item Conferido!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        return $item;
    }

    public function deletarItem()
    {
        return $this->alert('warning', 'Remover esse item da lista?', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonColor' => '#3085d6',
            'onConfirmed' => 'delete',
            'showCancelButton' => true,
            'cancelButtonColor' => '#f87171',
            'onDismissed' => '',
            'cancelButtonText' => 'FECHAR',
            'confirmButtonText' => 'CONFIRMAR',
        ]);
    }

    public function delete()
    {
        $item = ListaItem::where('lista_id', $this->listaId)->where('produto_id', $this->codigoProduto)->first();

        if ($item->delete()) {
            $this->dispatch('close-modal-small');

            return $this->alert('success', 'Item removido da lista!', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  true,
            ]);
        }
    }

    public function faltandoItem()
    {
        if ($this->faltandoProduto == 'S') {
            return $this->alert('warning', 'Encontrou o item?', [
                'position' => 'center',
                'timer' => 5000,
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#3085d6',
                'onConfirmed' => 'faltando',
                'showCancelButton' => true,
                'cancelButtonColor' => '#f87171',
                'onDismissed' => '',
                'cancelButtonText' => 'NÃO',
                'confirmButtonText' => 'SIM',
            ]);
        }

        return $this->alert('warning', 'Item não encontrado?', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonColor' => '#3085d6',
            'onConfirmed' => 'faltando',
            'showCancelButton' => true,
            'cancelButtonColor' => '#f87171',
            'onDismissed' => '',
            'cancelButtonText' => 'NÃO',
            'confirmButtonText' => 'SIM',
        ]);
    }

    public function faltando()
    {
        $faltando = 'S';

        if ($this->faltandoProduto == 'S') {
            $faltando = 'N';
        }

        $item = ListaItem::where('lista_id', $this->listaId)->where('produto_id', $this->codigoProduto)->update([
            'faltando' => $faltando,
        ]);

        if ($item) {
            $this->dispatch('close-modal-small');

            if ($this->faltandoProduto == 'S') {
                return $this->alert('success', 'Item encontrado!', [
                    'position' =>  'center',
                    'timer' =>  3000,
                    'toast' =>  true,
                ]);
            }

            return $this->alert('success', 'Item não encontrado!', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  true,
            ]);
        }
    }

    public function finalizarCompra()
    {
        return $this->alert('warning', 'Finalizar a compra?', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonColor' => '#3085d6',
            'onConfirmed' => 'finalizar',
            'showCancelButton' => true,
            'cancelButtonColor' => '#f87171',
            'onDismissed' => '',
            'cancelButtonText' => 'FECHAR',
            'confirmButtonText' => 'CONFIRMAR',
        ]);
    }

    public function finalizar()
    {
        $item = Lista::where('id', $this->listaId)->update([
            'status' => 'C',
            'data_conclusao' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($item) {
            $this->dispatch('close-modal-small');

            return $this->alert('success', 'Lista concluida!', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  true,
            ]);
        }
    }

    public function totais()
    {
        $this->produtosComprados = ListaItem::where('lista_id', $this->listaId)->where('quantidade', '>', 0)->count();
        $this->produtosFaltando = ListaItem::where('lista_id', $this->listaId)->where('faltando', 'S')->count();
    }

    public function gerarPDF()
    {
        return redirect()->route('pdf', ['codigo' => '1']);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->totais();
        return view('livewire.pages.listagem-itens', ['itens' => $this->dados()]);
    }
}
