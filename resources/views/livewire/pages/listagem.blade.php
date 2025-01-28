<div>
    @section('titulo', 'Listagem')
    @section('subtitulo', '')

    <!-- Loading -->
    @include('includes.loading')
    <!-- ./Loading -->

    <div class="w-full bg-white rounded-lg dark:bg-gray-800">
        <div class="relative flex flex-col">

            <div class="flex flex-col md:flex-row md:justify-between gap-2 mx-3 py-3">
                <div class="flex justify-around items-center gap-4">
                    <div class="sm:w-80 w-full">
                        <label>
                            <div class="flex items-center gap-1">
                                <div class="w-full">
                                    <x-input class="uppercase tracking-widest text-xs"
                                        placeholder="Procure pela a descrição" wire:model.blur="search"
                                        wire:keydown.enter='dados()' />
                                </div>

                                <x-buttons.primary wire:click="dados()">
                                    <x-icons.search class="size-5" />
                                </x-buttons.primary>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex justify-center">
                    <x-buttons.primary x-on:click="$dispatch('open-modal-small', { name : 'novaLista' })">
                        Criar Lista
                    </x-buttons.primary>
                </div>
            </div>

            <div class="flex flex-col items-center md:flex-row md:justify-between gap-2 mx-3 py-3">
            </div>

        </div>

        <div class="border my-2 mx-32 dark:border-gray-700"></div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs hidden lg:block">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr x-cloak x-data="{ tooltip: 'nenhum' }"
                            class="relative text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center cursor-pointer"
                                        wire:click="sortBy('id')" x-on:mouseover="tooltip = 'cod'"
                                        x-on:mouseleave="tooltip = 'nenhum'">
                                        <button
                                            class="text-xs font-medium leading-4 tracking-wider uppercase">Código</button>
                                        @include('includes.icon-filter', ['field' => 'id'])
                                    </div>

                                    <div x-cloak x-show="tooltip === 'cod'" x-transition x-transition.duration.300ms
                                        class="absolute z-10 p-2 mt-6 text-xs text-blue-500 font-bold bg-gray-100 rounded-md dark:bg-gray-700">
                                        <p>Ordenar pelo código</p>
                                    </div>
                                </div>
                            </th>

                            <th class="px-2 py-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center cursor-pointer"
                                        wire:click="sortBy('user')" x-on:mouseover="tooltip = 'user'"
                                        x-on:mouseleave="tooltip = 'nenhum'">
                                        <button class="text-xs font-medium leading-4 tracking-wider uppercase">
                                            Usuário
                                        </button>
                                        @include('includes.icon-filter', ['field' => 'user'])
                                    </div>

                                    <div x-cloak x-show="tooltip === 'user'" x-transition x-transition.duration.300ms
                                        class="absolute z-10 p-2 mt-6 text-xs text-blue-500 font-bold bg-gray-100 rounded-md dark:bg-gray-700">
                                        <p>Ordenar pelo o Usuário</p>
                                    </div>
                                </div>
                            </th>

                            <th class="px-4 py-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center cursor-pointer"
                                        wire:click="sortBy('descricao')" x-on:mouseover="tooltip = 'desc'"
                                        x-on:mouseleave="tooltip = 'nenhum'">
                                        <button class="text-xs font-medium leading-4 tracking-wider uppercase">
                                            Descrição
                                        </button>
                                        @include('includes.icon-filter', ['field' => 'descricao'])
                                    </div>

                                    <div x-cloak x-show="tooltip === 'desc'" x-transition x-transition.duration.300ms
                                        class="absolute z-10 p-2 mt-6 text-xs text-blue-500 font-bold bg-gray-100 rounded-md dark:bg-gray-700">
                                        <p>Ordenar pela a Descrição</p>
                                    </div>
                                </div>

                            </th>

                            <th class="px-4 py-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center cursor-pointer"
                                        wire:click="sortBy('data_criacao')" x-on:mouseover="tooltip = 'data_criacao'"
                                        x-on:mouseleave="tooltip = 'nenhum'">
                                        <button class="text-xs font-medium leading-4 tracking-wider uppercase">
                                            Data da Criação
                                        </button>
                                        @include('includes.icon-filter', ['field' => 'data_criacao'])
                                    </div>

                                    <div x-cloak x-show="tooltip === 'data_criacao'" x-transition
                                        x-transition.duration.300ms
                                        class="absolute z-10 p-2 mt-6 text-xs text-blue-500 font-bold bg-gray-100 rounded-md dark:bg-gray-700">
                                        <p>Ordenar pela Data da Criação</p>
                                    </div>
                                </div>
                            </th>

                            <th class="px-4 py-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center cursor-pointer"
                                        wire:click="sortBy('data_conclusao')"
                                        x-on:mouseover="tooltip = 'data_conclusao'"
                                        x-on:mouseleave="tooltip = 'nenhum'">
                                        <button class="text-xs font-medium leading-4 tracking-wider uppercase">
                                            Data da Conclusão
                                        </button>
                                        @include('includes.icon-filter', ['field' => 'data_conclusao'])
                                    </div>

                                    <div x-cloak x-show="tooltip === 'data_conclusao'" x-transition
                                        x-transition.duration.300ms
                                        class="absolute z-10 p-2 mt-6 text-xs text-blue-500 font-bold bg-gray-100 rounded-md dark:bg-gray-700">
                                        <p>Ordenar pela Data da Conclusão</p>
                                    </div>
                                </div>
                            </th>

                            <th class="py-3 text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($listas as $lista)
                            <tr wire:key="{{ $lista->id }}"
                                class="font-bold uppercase text-gray-600 tracking-widest text-sm ">

                                <td class="py-3 text-center text-blue-500">
                                    #{{ $lista->id }}
                                </td>

                                <td class="py-3 text-center">
                                    {{ $lista->nome_usuario }}
                                </td>

                                <td class="py-3 pr-8 text-center ">
                                    {{ $lista->descricao }}
                                </td>

                                <td class="py-3 pr-8 text-center">
                                    {{ date('d/m/Y', strtotime($lista->data_criacao)) }}
                                </td>

                                <td class="py-3 pr-8 text-center">
                                    @if ($lista->data_conclusao)
                                        {{ date('d/m/Y', strtotime($lista->data_conclusao)) }}
                                    @endif
                                </td>

                                <td class="relative py-3 text-center flex justify-center">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('listagem-itens', ['codigo' => $lista->id]) }}"
                                            class="px-2 py-2 font-medium leading-5 text-blue-600 rounded-full hover:bg-blue-100 hover:scale-95">
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z">
                                                </path>
                                            </svg>
                                        </a>

                                        <button wire:click="codigoDuplicar({{ $lista->id }})" x-data
                                            x-on:click="$dispatch('open-modal-small', { name : 'duplicarLista' })"
                                            class="inline-flex items-center w-full px-2 py-1 text-xs font-semibold text-red-600 uppercase transition-colors duration-150 rounded-md hover:bg-red-100">
                                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M6.9998 6V3C6.9998 2.44772 7.44752 2 7.9998 2H19.9998C20.5521 2 20.9998 2.44772 20.9998 3V17C20.9998 17.5523 20.5521 18 19.9998 18H16.9998V20.9991C16.9998 21.5519 16.5499 22 15.993 22H4.00666C3.45059 22 3 21.5554 3 20.9991L3.0026 7.00087C3.0027 6.44811 3.45264 6 4.00942 6H6.9998ZM8.9998 6H16.9998V16H18.9998V4H8.9998V6ZM6.9998 11V13H12.9998V11H6.9998ZM6.9998 15V17H12.9998V15H6.9998Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <div class="absolute left-[50%] mt-16 flex justify-center">
                                <h1
                                    class="text-sm font-semibold text-center tracking-widest uppercase bg-red-200 rounded w-44 p-1 dark:text-red-600">
                                    Sem registros
                                </h1>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-full overflow-y-auto p-4 block lg:hidden space-y-6">
            @foreach ($listas as $lista)
                <div wire:key="{{ $lista->id }}"
                    class="w-full p-3 rounded-lg space-y-2 border-2 transition-all hover:scale-95 {{ $lista->status == 'C' ? 'text-gray-600 bg-blue-300 border-blue-300' : 'text-gray-500' }}">
                    <div class="flex justify-between items-center">

                        <h1 class="font-bold uppercase tracking-widest my-1 text-blue-500">{{ $lista->descricao }}</h1>

                        <div x-data="{ menu: false, tooltip: 'nenhum' }" class="relative flex items-center space-x-2">

                            <button x-on:click="menu = !menu;" @keydown.escape="menu = false"
                                @click.away="menu = false;"
                                class="flex items-center justify-between px-2 py-2 font-medium leading-5 text-blue-600 rounded-full hover:bg-gray-200 hover:scale-95 dark:hover:text-white
                                         dark:text-gray-400 dark:hover:bg-gray-700">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z">
                                    </path>
                                </svg>
                            </button>

                            <template x-if="menu">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @keydown.escape="menu = false; "
                                    class="absolute right-7 top-8 z-40 w-44 p-2 mt-4 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md"
                                    aria-label="submenu">

                                    <li class="flex">
                                        <button
                                            onclick="window.location.href='{{ route('listagem-itens', ['codigo' => $lista->id]) }}'"
                                            class="inline-flex items-center w-full px-2 py-1 text-xs font-semibold uppercase transition-colors duration-150 rounded-md bg-blue-100 text-blue-600">
                                            <svg class="size-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z">
                                                </path>
                                            </svg>

                                            <span>Ver Lista</span>
                                        </button>

                                    </li>

                                    <li class="flex">
                                        <button wire:click="codigoDuplicar({{ $lista->id }})" x-data
                                            x-on:click="$dispatch('open-modal-small', { name : 'duplicarLista' })"
                                            class="inline-flex items-center w-full px-2 py-1 text-xs font-semibold uppercase transition-colors duration-150 rounded-md bg-red-100 text-red-600">
                                            <svg class="size-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M6.9998 6V3C6.9998 2.44772 7.44752 2 7.9998 2H19.9998C20.5521 2 20.9998 2.44772 20.9998 3V17C20.9998 17.5523 20.5521 18 19.9998 18H16.9998V20.9991C16.9998 21.5519 16.5499 22 15.993 22H4.00666C3.45059 22 3 21.5554 3 20.9991L3.0026 7.00087C3.0027 6.44811 3.45264 6 4.00942 6H6.9998ZM8.9998 6H16.9998V16H18.9998V4H8.9998V6ZM6.9998 11V13H12.9998V11H6.9998ZM6.9998 15V17H12.9998V15H6.9998Z">
                                                </path>
                                            </svg>

                                            <span>Duplicar Lista</span>
                                        </button>

                                    </li>
                                </ul>
                            </template>
                        </div>
                    </div>

                    <h1 class="font-bold uppercase text-sm tracking-widest my-4">data criação:
                        {{ date('d/m/Y', strtotime($lista->data_criacao)) }}
                    </h1>

                    @if ($lista->data_conclusao)
                        <h1 class="font-bold uppercase text-sm tracking-widest my-4">data conclusão:
                            {{ date('d/m/Y', strtotime($lista->data_conclusao)) }}
                        </h1>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="border my-4 mx-32 dark:border-gray-700"></div>

    </div>

    <x-modal.modal-small name="novaLista" title="Nova" subtitle="Lista">
        @slot('body')
            <form wire:submit="save()" class=" space-y-6">

                <div class="flex flex-col gap-3">
                    <div>
                        <x-inputs.label value="Descrição" />
                        <x-input wire:model="descricao" class="uppercase tracking-widest"
                            placeholder="insira uma descrição" />
                    </div>

                    <div class="w-full">
                        <x-inputs.label value="{{ 'Observação' }}" />
                        <x-textarea wire:model="obs" class="uppercase tracking-widest" resize-auto placeholder="..." />
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-buttons.primary type="submit">Criar lista</x-buttons.primary>
                </div>
            </form>
        @endslot
    </x-modal.modal-small>

    <x-modal.modal-small name="duplicarLista" title="Duplicar" subtitle="Lista">
        @slot('body')
            <form wire:submit="duplicarLista()" class=" space-y-6">

                <div class="flex flex-col gap-3">
                    <div>
                        <x-inputs.label value="Descrição" />
                        <x-input wire:model="descricaoDup" class="uppercase tracking-widest"
                            placeholder="insira a descrição" />
                    </div>

                    <div class="w-full">
                        <x-inputs.label value="{{ 'Observação' }}" />
                        <x-textarea wire:model="obsDup" class="uppercase tracking-widest" resize-auto
                            placeholder="..." />
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-buttons.primary type="submit">Duplicar lista</x-buttons.primary>
                </div>
            </form>
        @endslot
    </x-modal.modal-small>
</div>
