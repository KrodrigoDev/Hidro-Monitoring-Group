<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeEmpresa extends Model
{
    use HasFactory;

    protected $table = 'unidade_empresa';

    protected $fillable = [
        'municipio_id',
        'empresa_id',
    ];

    public $timestamps = true;

    /**
     * 🔗 Relacionamentos
     */

    // Uma unidade pertence a um município
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    // Uma unidade pertence a uma empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    // Uma unidade pode ter vários usuários vinculados
    public function usuarios()
    {
        return $this->hasMany(UsuarioUnidade::class, 'unidade_empresa_id');
    }

    // Uma unidade pode ter vários logs de usuário
    public function logs()
    {
        return $this->hasMany(LogUsuario::class, 'unidade_empresa_id');
    }
}
