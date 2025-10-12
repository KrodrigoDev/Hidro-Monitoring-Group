<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioBase extends Model
{
    use HasFactory;

    protected $table = 'usuario_base';

    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'senha',
        'cpf',
    ];

    public $timestamps = true;

    /**
     * 🔗 Relacionamentos
     */

    // Um usuário base pode estar vinculado a vários registros em usuario_unidade
    public function unidades()
    {
        return $this->hasMany(UsuarioUnidade::class, 'usuario_id');
    }

    // Um usuário base pode ter vários logs onde ele foi criado
    public function logsCriado()
    {
        return $this->hasMany(LogUsuario::class, 'usuario_criado_id');
    }

    // se quiser ver logs em que ele foi o criador, é possível criar também:
    public function logsCriador()
    {
        return $this->hasMany(LogUsuario::class, 'usuario_criador_id');
    }
}
