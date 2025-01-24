<div x-data="{ view: 1 }">
    <form x-show="view === 1" wire:submit="login()" class="flex flex-col gap-4">
        <div>
            <x-inputs.label value="Email" />
            <x-input class="uppercase tracking-widest text-xs" type="email" wire:model="email"
                placeholder="insira o email aqui" required />
        </div>

        <div>
            <x-inputs.label value="Senha" />
            <x-password wire:model="senha" wire:keydown.enter="login()" placeholder="* * * * * * *" />
        </div>

        <div class="flex flex-col gap-6 justify-center">
            <x-buttons.primary type="submit">Entrar</x-buttons.primary>

            <h1 x-on:click="view = 2"
                class="text-center text-xs text-gray-400 uppercase tracking-widest font-semibold transition-all hover:underline hover:cursor-pointer">
                Crie sua conta</h1>
        </div>
    </form>

    <form x-show="view === 2" wire:submit="save()" class="flex flex-col gap-4">
        <div>
            <x-inputs.label value="Email" />
            <x-input class="uppercase tracking-widest text-xs" type="email" wire:model="email"
                placeholder="insira o email aqui" required />
        </div>

        <div>
            <x-inputs.label value="Nome" />
            <x-input class="uppercase tracking-widest text-xs" wire:model="nome" placeholder="insira o nome aqui"
                required />
        </div>

        <div>
            <x-inputs.label value="Senha" />
            <x-password wire:model="senha" placeholder="* * * * * * *" />
        </div>

        <x-buttons.primary class="w-full" type="submit">Criar Conta</x-buttons.primary>

        <h1 x-on:click="view = 1"
            class="text-center text-xs text-gray-400 uppercase tracking-widest font-semibold transition-all hover:underline hover:cursor-pointer">
            Entrar
            com Email e senha</h1>
    </form>
</div>
