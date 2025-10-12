<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEquipamento extends Model
{
    use HasFactory;

    protected $table = 'log_equipamento';

    protected $fillable = [
        'equipamento_id',
        'usuario_unidade_id',
        'acao',
        'descricao',
    ];

    public $timestamps = true;

    /**
     * 🔗 Relacionamentos
     */

    /**
     * O log pertence a um equipamento.
     */
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    /**
     * O log pertence a um usuário de unidade.
     */
    public function usuarioUnidade()
    {
        return $this->belongsTo(UsuarioUnidade::class, 'usuario_unidade_id');
    }
}
