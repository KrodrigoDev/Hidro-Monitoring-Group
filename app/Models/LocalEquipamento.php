<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalEquipamento extends Model
{
    use HasFactory;

    protected $table = 'local_equipamento';

    protected $fillable = [
        'municipio_id',
        'referencia',
        'latitude',
        'longitude',
    ];

    /**
     * 🔗 Relacionamentos
     */

    // Relacionamento: Local do equipamento pertence a um município
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }
}
