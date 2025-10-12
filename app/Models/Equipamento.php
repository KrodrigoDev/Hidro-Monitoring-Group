<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    protected $table = 'equipamento';

    protected $fillable = [
        'descricao',
        'tipo_id',
        'atributo_id',
        'unidade_empresa_id',
        'local_id',
        'situacao_id',
    ];

    public $timestamps = true;

    /**
     * 🔗 Relacionamentos
     */

    /**
     * O equipamento pertence a um tipo de equipamento.
     */
    public function tipo()
    {
        return $this->belongsTo(TipoEquipamento::class, 'tipo_id');
    }

    /**
     * O equipamento pertence a uma situação.
     */
    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }

    /**
     * O equipamento pertence a uma unidade/empresa.
     */
    public function unidadeEmpresa()
    {
        return $this->belongsTo(UnidadeEmpresa::class, 'unidade_empresa_id');
    }

    /**
     * O equipamento pertence a um local.
     */
    public function local()
    {
        return $this->belongsTo(LocalEquipamento::class, 'local_id');
    }
}
