<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atributo extends Model
{
    use HasFactory;

    protected $table = 'atributo';

    protected $fillable = [
        'nome',
        'equipamento_id',
    ];

    /**
     * 🔗 Relacionamentos
     */

    // Relacionamento: Atributo pertence a um Equipamento
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }
}
