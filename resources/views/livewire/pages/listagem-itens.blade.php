<div x-data="initApp()">
    @section('titulo', 'Listagem')
    @section('subtitulo', 'Itens')

    <!-- Loading -->
    @include('includes.loading')
    <!-- ./Loading -->

    <div class="relative grid sm:grid-cols-4 gap-4 items-start">

        <div class="sm:col-span-3">
            <div class="bg-white p-3 rounded-lg shadow-lg">
                <h1 class="text-gray-400 uppercase text-sm tracking-widest border-b">informações</h1>
                <div class="mt-5">
                    <x-inputs.label value="Descrição" />
                    <x-input wire:model="descricao" class="uppercase tracking-widest text-sm"
                        placeholder="insira uma descrição" disabled />
                </div>

                @if ($status == 'A')
                    <div class="mt-2 flex justify-end">
                        <x-buttons.purple x-on:click="$dispatch('open-modal-small', { name : 'finalizar' })">Finalizar
                            compra</x-buttons.purple>
                    </div>
                @endif
            </div>

            <div class="bg-white p-3 mt-4 rounded-lg shadow-lg sm:block hidden">
                <div class="flex items-center justify-between">
                    <h1 class="text-gray-400 uppercase text-sm tracking-widest border-b">itens</h1>

                    <div x-data="{ message: false }" class="relative flex items-center gap-2">
                        <div>
                            <button x-on:click="message = !message;"
                                class="font-bold tracking-widest text-blue-500 bg-blue-200 p-2 rounded-full hover:scale-95 transition-all">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M3 3H12.382C12.7607 3 13.107 3.214 13.2764 3.55279L14 5H20C20.5523 5 21 5.44772 21 6V17C21 17.5523 20.5523 18 20 18H13.618C13.2393 18 12.893 17.786 12.7236 17.4472L12 16H5V22H3V3Z">
                                    </path>
                                </svg>
                            </button>

                            <div x-show="message">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @keydown.escape="message = false; " @click.away="message = false;"
                                    class="absolute right-1 z-40 w-56 p-2 mt-4 space-y-4 text-gray-600 bg-white border shadow-lg rounded-md dark:shadow-gray-800 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700"
                                    aria-label="submenu">

                                    <h1 class="font-bold tracking-wider">Legendas</h1>

                                    <div class="space-y-2 text-xs font-bold">
                                        <div class="mt-2">
                                            <div class="relative flex gap-1 items-center">
                                                <div class="bg-orange-300 p-2 rounded-full"></div>
                                                <x-inputs.label value="{{ 'Não conferido' }}" />
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="relative flex gap-1 items-center">
                                                <div class="bg-blue-300 p-2 rounded-full"></div>
                                                <x-inputs.label value="{{ 'Conferido' }}" />
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="relative flex gap-1 items-center">
                                                <div class="bg-red-300 p-2 rounded-full"></div>
                                                <x-inputs.label value="{{ 'Qtd comprada maior' }}" />
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="relative flex gap-1 items-center">
                                                <div class="bg-green-300 p-2 rounded-full"></div>
                                                <x-inputs.label value="{{ 'Não encontrado' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>

                        @if ($status == 'A')
                            <x-buttons.primary wire:click="produto(0)"
                                x-on:click="$dispatch('open-modal-small', { name : 'cadastro' }), adicionar()">
                                Adicionar item
                            </x-buttons.primary>
                        @endif
                    </div>
                </div>

                <div class="border my-2 mx-32 dark:border-gray-700"></div>

                <div class="sm:block hidden mt-4">
                    <!-- Ordenação -->
                    <div class="flex flex-wrap gap-2 mb-2 text-xs">
                        <div
                            class="p-1 text-left border-2 rounded-md hover:text-blue-800 dark:hover:text-blue-500 dark:border-gray-700">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('nome')">
                                <button
                                    class="text-xs font-bold leading-4 tracking-wider uppercase text-gray-500">Nome</button>
                                @include('includes.icon-filter', ['field' => 'nome'])
                            </div>
                        </div>

                        <div
                            class="p-1 text-left border-2 rounded-md hover:text-blue-800 dark:hover:text-blue-500 dark:border-gray-700">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('quantidade')">
                                <button class="text-xs font-bold leading-4 tracking-wider uppercase text-gray-500">Qtd
                                    Comprada</button>
                                @include('includes.icon-filter', ['field' => 'quantidade'])
                            </div>
                        </div>
                    </div>
                    <!--/ Ordenação -->
                </div>

                <!-- CARD -->
                <div class="flex flex-col gap-4">
                    @foreach ($itens as $item)
                        <div wire:click="produto({{ $item->produto_codigo }})"
                            x-on:click="$dispatch('open-modal-small', { name : 'produto' }), produto()"
                            class="flex flex-row gap-3 p-2 space-y-0 rounded-xl border-2 shadow-lg transition-all hover:scale-95 @if ($item->faltando == 'S') bg-green-300 border-green-300 @else {{ $item->quantidade == $item->quantidade_pedida ? 'bg-blue-300 border-blue-300' : '' }} {{ $item->quantidade < $item->quantidade_pedida ? 'bg-orange-300 border-orange-300' : '' }} {{ $item->quantidade > $item->quantidade_pedida ? 'bg-red-300 border-red-300' : '' }} @endif ">
                            <div
                                class="relative flex justify-center object-none content-center w-24 overflow-hidden rounded justify-items-center">
                                <img src="{{ asset('img/foto.png') }}" alt="sem foto">
                            </div>

                            <div class="space-y-1 tracking-widest">
                                <h1 class="text-sm font-bold text-blue-500">#{{ $item->produto_codigo }}</h1>

                                <div class="font-bold uppercase text-blue-500">
                                    {{ $item->nome }}
                                </div>

                                <div class="text-xs font-bold uppercase">
                                    valor: R${{ number_format($item->valor, 2, ',') }}
                                </div>

                                <div class="text-xs font-bold uppercase">
                                    qtd: {{ $item->quantidade_pedida }}
                                </div>

                                <div class="text-xs font-bold uppercase">
                                    qtd comprada: {{ $item->quantidade }}
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <!--./CARD -->
            </div>
        </div>


        <div class="bg-white p-3 rounded-lg shadow-lg hidden sm:block">
            <h1 class="text-gray-400 uppercase text-sm tracking-widest border-b">Totais</h1>


            <div class="flex justify-between items-end text-sm font-bold uppercase tracking-wider text-gray-500">
                <h1>total da compra:</h1>
                <span class="text-lg text-blue-400">R$ {{ number_format($totalLista, 2, ',') }}</span>
            </div>
        </div>

        <div x-data="{ message: false }" class="bg-white p-3 rounded-lg shadow-lg block sm:hidden">
            <div class="flex items-center justify-between">
                <h1 class="text-gray-400 uppercase text-sm tracking-widest border-b">itens</h1>

                <div class="flex items-center gap-2">
                    <div>
                        <button x-on:click="message = !message;"
                            class="font-bold tracking-widest text-blue-500 bg-blue-200 p-2 rounded-full hover:scale-95 transition-all">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M3 3H12.382C12.7607 3 13.107 3.214 13.2764 3.55279L14 5H20C20.5523 5 21 5.44772 21 6V17C21 17.5523 20.5523 18 20 18H13.618C13.2393 18 12.893 17.786 12.7236 17.4472L12 16H5V22H3V3Z">
                                </path>
                            </svg>
                        </button>

                        <div x-show="message">
                            <ul x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @keydown.escape="message = false; " @click.away="message = false;"
                                class="absolute right-1 z-40 w-56 p-2 mt-4 space-y-4 text-gray-600 bg-white border shadow-lg rounded-md dark:shadow-gray-800 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700"
                                aria-label="submenu">

                                <h1 class="font-bold tracking-wider">Legendas</h1>

                                <div class="space-y-2 text-xs font-bold">
                                    <div class="mt-2">
                                        <div class="relative flex gap-1 items-center">
                                            <div class="bg-orange-300 p-2 rounded-full"></div>
                                            <x-inputs.label value="{{ 'Não conferido' }}" />
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="relative flex gap-1 items-center">
                                            <div class="bg-blue-300 p-2 rounded-full"></div>
                                            <x-inputs.label value="{{ 'Conferido' }}" />
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="relative flex gap-1 items-center">
                                            <div class="bg-red-300 p-2 rounded-full"></div>
                                            <x-inputs.label value="{{ 'Qtd comprada maior' }}" />
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="relative flex gap-1 items-center">
                                            <div class="bg-green-300 p-2 rounded-full"></div>
                                            <x-inputs.label value="{{ 'Não encontrado' }}" />
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                    @if ($status == 'A')
                        <x-buttons.primary wire:click="produto(0)"
                            x-on:click="$dispatch('open-modal-small', { name : 'cadastro' }), adicionar()">
                            Adicionar item
                        </x-buttons.primary>
                    @endif
                </div>
            </div>

            <div class="border my-4 mx-32 dark:border-gray-700"></div>

            <div class="block lg:hidden mt-4">
                <!-- Ordenação -->
                <div class="flex flex-wrap gap-2 mb-2 text-xs">
                    <div
                        class="p-1 text-left border-2 rounded-md hover:text-blue-800 dark:hover:text-blue-500 dark:border-gray-700">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('nome')">
                            <button
                                class="text-xs font-bold leading-4 tracking-wider uppercase text-gray-500">Nome</button>
                            @include('includes.icon-filter', ['field' => 'nome'])
                        </div>
                    </div>

                    <div
                        class="p-1 text-left border-2 rounded-md hover:text-blue-800 dark:hover:text-blue-500 dark:border-gray-700">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('quantidade')">
                            <button class="text-xs font-bold leading-4 tracking-wider uppercase text-gray-500">Qtd
                                Comprada</button>
                            @include('includes.icon-filter', ['field' => 'quantidade'])
                        </div>
                    </div>
                </div>
                <!--/ Ordenação -->
            </div>

            <!-- CARD -->
            <div class="flex flex-col gap-4">
                @foreach ($itens as $item)
                    <div wire:click="produto({{ $item->produto_codigo }})"
                        x-on:click="$dispatch('open-modal-small', { name : 'produto' }), produto()"
                        class="flex flex-row gap-3 p-2 space-y-0 rounded-xl border-2 shadow-lg transition-all hover:scale-95 @if ($item->faltando == 'S') bg-green-300 border-green-300 @else {{ $item->quantidade == $item->quantidade_pedida ? 'bg-blue-300 border-blue-300' : '' }} {{ $item->quantidade < $item->quantidade_pedida ? 'bg-orange-300 border-orange-300' : '' }} {{ $item->quantidade > $item->quantidade_pedida ? 'bg-red-300 border-red-300' : '' }} @endif ">
                        <div
                            class="relative flex justify-center object-none content-center w-24 overflow-hidden rounded justify-items-center">
                            <img src="{{ asset('img/foto.png') }}" alt="sem foto">
                        </div>

                        <div class="space-y-1 tracking-widest">
                            <h1 class="text-sm font-bold text-blue-500">#{{ $item->produto_codigo }}</h1>

                            <div class="font-bold uppercase text-blue-500">
                                {{ $item->nome }}
                            </div>

                            <div class="text-xs font-bold uppercase">
                                valor: R${{ number_format($item->valor, 2, ',') }}
                            </div>

                            <div class="text-xs font-bold uppercase">
                                qtd: {{ $item->quantidade_pedida }}
                            </div>

                            <div class="text-xs font-bold uppercase">
                                qtd comprada: {{ $item->quantidade }}
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <!--./CARD -->
        </div>
    </div>

    <x-modal.modal-small name="cadastro" title="Adicionar" subtitle="Produto">
        @slot('body')
            <div class="space-y-6">
                <form wire:submit="adicionarItem(item.qtd)" class="flex flex-col gap-5">
                    <div>
                        <x-inputs.label value="nome*" />
                        <x-input wire:model="nome" class="uppercase tracking-widest" placeholder="insira o nome"
                            required />
                    </div>

                    <div>
                        <x-inputs.label value="descrição" />
                        <x-input wire:model="desc" class="uppercase tracking-widest" placeholder="insira a descricao" />
                    </div>

                    <div class="flex flex-col items-center">
                        <x-inputs.label value="{{ 'Quantidade' }}" />
                        <div class="flex items-center gap-1">
                            <div x-on:click="remove()"
                                class="text-white bg-red-500 p-1 rounded-full transition-all hover:scale-95">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M19 11H5V13H19V11Z"></path>
                                </svg>
                            </div>

                            <div class="w-20">
                                <x-input class="text-center" x-model.number="item.qtd" wire:model="quantidade"
                                    x-mask:dynamic="$input.startsWith('37')
                                        ? '999999999' : '999999999'
                                "
                                    required />
                            </div>

                            <div x-on:click="add()"
                                class="text-white bg-blue-500 p-1 rounded-full transition-all hover:scale-95">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                                </svg>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end">
                        <x-buttons.primary type="submit">Adicionar</x-buttons.primary>
                    </div>
                </form>
            </div>
        @endslot
    </x-modal.modal-small>

    <x-modal.modal-small name="produto" title="Conferindo" subtitle="Produto">
        @slot('body')
            <h1 class="text-lg font-semibold uppercase tracking-widest text-orange-400">{{ $nome }}</h1>

            <div class="border my-2 mx-10 dark:border-gray-700"></div>

            <div class="space-y-6">
                <div class="flex flex-col gap-2">
                    <div>
                        <x-inputs.label value="descrição" />
                        <x-input wire:model="desc" class="uppercase tracking-widest" placeholder="insira a descrição" />
                    </div>

                    <div>
                        <x-inputs.label value="marca" />
                        <x-input wire:model="marca" class="uppercase tracking-widest" placeholder="insira a marca" />
                    </div>

                    {{-- <div class="w-full">
                        <x-inputs.label value="{{ 'Observação' }}" />
                        <x-textarea wire:model="observacao" class="uppercase tracking-widest" rows="2"
                            maxlength="50" count placeholder="..." />
                    </div> --}}

                    <div class="flex flex-col items-center">
                        <x-inputs.label value="{{ 'Qtd Pedida' }}" />
                        <div class="flex items-center gap-1">
                            <button x-on:click="removePedida()"
                                class="text-white bg-red-500 p-1 rounded-full transition-all hover:scale-95">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M19 11H5V13H19V11Z"></path>
                                </svg>
                            </button>

                            <div class="w-20">
                                <x-input class="text-center" x-model.number="item.qtdPedida"
                                    wire:model="quantidadePedida"
                                    x-mask:dynamic="$input.startsWith('37')
                                ? '999999999' : '999999999'
                        " />
                            </div>

                            <button x-on:click="item.qtdPedida++"
                                class="text-white bg-blue-500 p-1 rounded-full transition-all hover:scale-95">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                                </svg>
                            </button>
                        </div>

                    </div>

                    @if ($status == 'A')
                        <div class="flex justify-center gap-4">
                            <div class="flex flex-col items-center">
                                <x-inputs.label value="{{ 'Preço' }}" />

                                <div class="w-32">
                                    <x-input wire:model="preco" x-model.number="item.valor"
                                        x-mask:dynamic="$money($input)" />
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <x-inputs.label value="{{ 'Qtd Comprada' }}" />
                                <div class="flex items-center gap-1">
                                    <button x-on:click="remove()"
                                        class="text-white bg-red-500 p-1 rounded-full transition-all hover:scale-95">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path d="M19 11H5V13H19V11Z"></path>
                                        </svg>
                                    </button>

                                    <div class="w-20">
                                        <x-input class="text-center" x-model.number="item.qtd" wire:model="quantidade"
                                            x-mask:dynamic="$input.startsWith('37')
                                        ? '999999999' : '999999999'
                                " />
                                    </div>

                                    <button x-on:click="add()"
                                        class="text-white bg-blue-500 p-1 rounded-full transition-all hover:scale-95">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="border mt-4 mx-10 dark:border-gray-700"></div>
                    @if ($status == 'A')
                        <h1 class="text-sm text-center uppercase font-semibold tracking-widest">Total: R$<span
                                x-text="item.total"></span></h1>
                    @endif

                    @if ($status == 'C')
                        <h1 class="text-sm text-center uppercase font-semibold tracking-widest">Qtd comprada:
                            {{ $quantidadeProduto }}</h1>
                        <h1 class="text-sm text-center uppercase font-semibold tracking-widest">Total: R$
                            {{ number_format($totalProduto, 2, ',') }}</h1>
                    @endif

                    @if ($status == 'A')
                        <div class="flex justify-between">
                            <div>
                                <x-buttons.red wire:click="deletarItem()">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M7 6V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7ZM13.4142 13.9997L15.182 12.232L13.7678 10.8178L12 12.5855L10.2322 10.8178L8.81802 12.232L10.5858 13.9997L8.81802 15.7675L10.2322 17.1817L12 15.4139L13.7678 17.1817L15.182 15.7675L13.4142 13.9997ZM9 4V6H15V4H9Z">
                                        </path>
                                    </svg>
                                </x-buttons.red>

                                <x-buttons.green wire:click="faltandoItem()">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M12.8659 3.00017L22.3922 19.5002C22.6684 19.9785 22.5045 20.5901 22.0262 20.8662C21.8742 20.954 21.7017 21.0002 21.5262 21.0002H2.47363C1.92135 21.0002 1.47363 20.5525 1.47363 20.0002C1.47363 19.8246 1.51984 19.6522 1.60761 19.5002L11.1339 3.00017C11.41 2.52187 12.0216 2.358 12.4999 2.63414C12.6519 2.72191 12.7782 2.84815 12.8659 3.00017ZM10.9999 16.0002V18.0002H12.9999V16.0002H10.9999ZM10.9999 9.00017V14.0002H12.9999V9.00017H10.9999Z">
                                        </path>
                                    </svg>
                                </x-buttons.green>
                            </div>


                            <x-buttons.primary
                                wire:click="conferindoItem(item.qtd,item.qtdPedida)">Adicionar</x-buttons.primary>
                        </div>
                    @endif
                </div>
            </div>
        @endslot
    </x-modal.modal-small>

    <x-modal.modal-small name="finalizar" title="Finalizar" subtitle="Compras">
        @slot('body')
            <div class="space-y-6">
                <div class="flex flex-col gap-3 text-sm text-center uppercase font-bold tracking-widest">
                    <div class="flex justify-between items-end text-sm text-gray-600">
                        <h1>produtos comprados:</h1>
                        <span class="text-lg text-blue-400">{{ $produtosComprados }}</span>
                    </div>

                    <div class="flex justify-between items-end text-sm text-gray-600">
                        <h1>produtos faltando:</h1>
                        <span class="text-lg text-green-400">{{ $produtosFaltando }}</span>
                    </div>

                    <div class="border mt-4 mx-10 dark:border-gray-700"></div>
                    <h1 class="text-sm text-center uppercase font-semibold tracking-widest">Total: R$
                        {{ number_format($totalLista, 2, ',') }}</h1>

                    <div class="flex justify-center">
                        <x-buttons.purple wire:click="finalizarCompra()">Finalizar</x-buttons.purple>
                    </div>
                </div>
            </div>
        @endslot
    </x-modal.modal-small>

    <div class="fixed bottom-0 left-0 w-full flex justify-center lg:hidden" x-data="{ openTotal: false }" x-cloak
        x-on:keydown.away="openTotal = false" x-on:click.away="openTotal = false"
        x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div
            class="relative mx-5 text-xs uppercase font-bold space-y-2  p-2 w-96 rounded-t-lg transition-all duration-300 bg-white">

            <div class="flex items-center justify-between" x-on:click="openTotal = !openTotal">
                <h1 class="text-gray-400 uppercase text-sm tracking-widest">Totais</h1>

                <button>
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z">
                        </path>
                    </svg>
                </button>
            </div>

            <div x-show="openTotal" class="text-lg text-gray-500">

                <div class="border my-4 mx-10 dark:border-gray-700"></div>

                <div class="flex justify-between items-end text-sm">
                    <h1>total da compra:</h1>
                    <span class="text-lg text-blue-400">R$ {{ number_format($totalLista, 2, ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initApp() {
        const app = {
            item: {
                qtd: {{ $quantidade }},
                qtdPedida: {{ $quantidadePedida }},
                valor: '',
                total: 0,
            },
            add() {
                if (this.item.valor == 0) {
                    this.item.qtd = 0;
                };

                this.item.qtd++;
                this.item.total = this.item.valor * this.item.qtd;
            },
            remove() {
                if (this.item.valor == 0) {
                    this.item.qtd = 0;
                };

                this.item.qtd--;

                this.item.total = this.item.total - this.item.valor;

                if (this.item.qtd < 0) {
                    this.item.qtd = 0;
                    this.item.total = 0;
                }
            },
            removePedida() {
                this.item.qtdPedida--;

                if (this.item.qtdPedida < 0) {
                    this.item.qtdPedida = 0;
                }
            },
            produto() {
                this.item.qtd = 0;
                this.item.valor = '';
                this.item.total = 0;
            },
            adicionar() {
                this.item.qtd = 0;
                this.item.valor = 1;
                this.item.total = 0;
            },
        };
        return app;
    }
</script>
</div>
