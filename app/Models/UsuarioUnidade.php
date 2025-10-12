<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioUnidade extends Model
{
    use HasFactory;

    protected $table = 'usuario_unidade';

    protected $fillable = [
        'usuario_id',
        'unidade_empresa_id',
        'permissao_id',
        'acesso_extra',
    ];

    /**
     * 🔗 Relacionamentos
     */

    // UsuárioUnidade pertence a um UsuárioBase
    public function usuario()
    {
        return $this->belongsTo(UsuarioBase::class, 'usuario_id');
    }

    // UsuárioUnidade pertence a uma UnidadeEmpresa
    public function unidadeEmpresa()
    {
        return $this->belongsTo(UnidadeEmpresa::class, 'unidade_empresa_id');
    }

    // UsuárioUnidade pertence a uma Permissão
    public function permissao()
    {
        return $this->belongsTo(Permissao::class, 'permissao_id');
    }
}
