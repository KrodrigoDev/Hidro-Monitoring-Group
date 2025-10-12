<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUsuario extends Model
{
    use HasFactory;

    protected $table = 'log_usuario';

    protected $fillable = [
        'usuario_criador_id',
        'usuario_criado_id',
        'unidade_empresa_id',
    ];

    public $timestamps = true;

    /**
     * 🔗 Relacionamentos
     */

    // Criador do usuário (referência a usuario_unidade)
    public function usuarioCriador()
    {
        return $this->belongsTo(UsuarioUnidade::class, 'usuario_criador_id');
    }

    // Usuário criado (referência a usuario_base)
    public function usuarioCriado()
    {
        return $this->belongsTo(UsuarioBase::class, 'usuario_criado_id');
    }

    // Unidade da empresa relacionada ao log
    public function unidadeEmpresa()
    {
        return $this->belongsTo(UnidadeEmpresa::class, 'unidade_empresa_id');
    }
}
