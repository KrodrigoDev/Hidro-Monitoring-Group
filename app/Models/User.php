<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- 1. ADICIONEI ISSO

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens; // <-- 2. ADICIONEI HasApiTokens

    /**
     * A tabela associada a este modelo.
     *
     * @var string
     */
    protected $table = 'usuario_base'; // <-- 3. ADICIONEI ISSO

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ // <-- 4. ALTEREI A LISTA
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'senha',
        'cpf',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [ // <-- 5. ALTEREI A LISTA
        'senha',
    ];

    /**
     * Define o nome da coluna de senha para a autenticação.
     * (Este é o passo mais importante)
     *
     * @return string
     */
    public function getAuthPasswordName() // <-- 6. ADICIONEI ESTA FUNÇÃO
    {
        return 'senha';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // <-- 7. ALTEREI O CONTEÚDO
    {
        return [
            'data_nascimento' => 'date',
            'senha' => 'hashed', // Mudado de 'password' para 'senha'
        ];
    }
}