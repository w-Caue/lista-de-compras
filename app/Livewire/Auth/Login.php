<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    #[Validate('required')]
    public $email;

    #[Validate('required')]
    public $senha;

    public $nome;

    public function login()
    {
        $this->validate();

        $email = trim($this->email);
        $user = User::where('email', $email)->first();

        if ($user == null) {
            return $this->alert('error', 'Usuário não encontrado.', [
                'position' => 'center',
                'text' => 'Verifique as credenciais de login.',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        $senhaCorreta = Hash::check($this->senha, $user->password);

        if (!$senhaCorreta) {
            return $this->alert('error', 'Senha incorreta!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        Auth::login($user, false);
        return redirect()->route('listagem');
    }

    public function save()
    {
        $user = User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => Hash::make($this->senha),
        ]);

        if ($user->save()) {
            Auth::login($user, false);

            $this->alert('success', 'Conta cadastrada!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);

            return redirect()->route('listagem');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
