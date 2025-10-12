<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';

    protected $fillable = [
        'nome',
        'cod_ibge',
        'estado_id',
    ];

    public $timestamps = false;

    /**
     * 🔗 Relacionamentos
     */

    /**
     * O município pertence a um estado.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
