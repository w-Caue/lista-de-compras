<?php

namespace App\Livewire\Pages;

use App\Models\Lista;
use App\Models\ListaItem;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Listagem extends Component
{
    use LivewireAlert;

    public $sortField = 'id';
    public $sortAsc = false;

    public $porPagina = 5;

    public $readyToLoad = false;

    public $search;

    public $dataIni;
    public $dataFim;

    public $descricao;
    public $obs;

    #DUPLICAR LISTA
    public $codListaDuplicada;
    public $descricaoDup;
    public $obsDup;
    public $qtdDuplicada = 'N';

    public function load()
    {
        $this->readyToLoad = true;
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

    public function mount()
    {
        $this->dataIni =  Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dataFim =  Carbon::now()->format('Y-m-d');
    }


    public function dados()
    {
        $listas = Lista::select([
            'users.name as nome_usuario',
            'listas.*',
        ])
            ->leftjoin('users', 'users.id', '=', 'listas.usuario')
            ->where('listas.usuario', Auth::user()->id)

            ->when(!empty($this->search), function ($query) {
                $string = trim($this->search);

                return $query->where('descricao', 'LIKE', '%' . $string . '%');
            })

            ->get();

        return $listas;
    }

    public function save()
    {
        $lista = Lista::create([
            'usuario' => Auth::user()->id,
            'descricao' => $this->descricao,
            'observacao' => $this->obs,
            'data_criacao' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($lista->save()) {
            $this->alert('success', 'Lista criada!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);

            return redirect()->route('listagem-itens', ['codigo' => $lista->id]);
        }
    }

    public function codigoDuplicar($codigo)
    {
        $this->codListaDuplicada = $codigo;
    }

    public function duplicarLista()
    {
        $lista = Lista::create([
            'usuario' => Auth::user()->id,
            'descricao' => $this->descricaoDup,
            'observacao' => $this->obsDup,
            'data_criacao' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($lista->save()) {
            $itens = ListaItem::select([
                'listas_itens.*',
                'produtos.id as produto_codigo',
                'produtos.nome',
                'produtos.marca',
                'produtos.descricao',
                'produtos.quantidade as quantidade_pedida',
            ])
                ->leftjoin('produtos', 'produtos.id', '=', 'listas_itens.produto_id')
                ->where('listas_itens.lista_id', $this->codListaDuplicada)
                ->get();

            foreach ($itens as $item) {
                $produto = Produto::create([
                    'nome' => $item->nome,
                    'descricao' => $item->descricao,
                    'marca' => $item->marca,
                    'quantidade' => $item->quantidade_pedida,
                ]);

                ListaItem::create([
                    'lista_id' => $lista->id,
                    'produto_id' => $produto->id,
                ]);
            }

            $this->alert('success', 'Lista Duplicada!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);

            return redirect()->route('listagem-itens', ['codigo' => $lista->id]);
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.listagem', ['listas' => $this->dados()]);
    }
}
