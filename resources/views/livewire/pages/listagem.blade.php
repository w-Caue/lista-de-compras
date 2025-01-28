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
                    <x-buttons.primary x-on:click="$dispatch('open-modal-small', { name : 'cadastro' })">
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

                                <td x-data="{ menu: false, tooltip: 'nenhum' }" class="relative py-3 text-center flex justify-center">
                                    <a href="{{ route('listagem-itens', ['codigo' => $lista->id]) }}"
                                        class="px-2 py-2 font-medium leading-5 text-blue-600 rounded-full hover:bg-gray-200 hover:scale-95 dark:hover:text-white
                                                         dark:text-gray-400 dark:hover:bg-gray-700">
                                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z">
                                            </path>
                                        </svg>
                                    </a>
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
                    onclick="window.location.href='{{ route('listagem-itens', ['codigo' => $lista->id]) }}'"
                    class="w-full p-3 rounded-lg space-y-2 border-2 shadow-md transition-all hover:scale-95 {{ $lista->status == 'C' ? 'text-gray-600 bg-blue-300 border-blue-300' : 'text-gray-500' }}">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-blue-500">#{{ $lista->id }}</span>

                        <h1 class="font-bold text-md uppercase tracking-widest text-blue-500">
                            {{ $lista->nome_usuario }}
                        </h1>

                        <h1 class="font-bold text-sm uppercase tracking-widest">
                            {{ date('d/m/Y', strtotime($lista->data_criacao)) }}</h1>
                    </div>

                    <h1 class="font-bold uppercase tracking-widest my-4">{{ $lista->descricao }}</h1>
                </div>
            @endforeach
        </div>

        <div class="border my-4 mx-32 dark:border-gray-700"></div>

    </div>

    <x-modal.modal-small name="cadastro" title="Nova" subtitle="Lista">
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
</div>
