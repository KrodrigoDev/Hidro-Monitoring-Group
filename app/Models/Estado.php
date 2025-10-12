<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';

    protected $fillable = [
        'nome',
        'cod_ibge',
        'sigla',
    ];

    /**
    * 🔗 Relacionamentos
    */

    // Exemplo de relacionamento: um estado pode ter muitos municípios
    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id');
    }
}
