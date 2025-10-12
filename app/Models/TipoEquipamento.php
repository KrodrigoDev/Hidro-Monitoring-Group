<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    use HasFactory;

    protected $table = 'tipo_equipamento';

    protected $fillable = [
        'nome',
        'categoria',
    ];

    public $timestamps = true;
}
