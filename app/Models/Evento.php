<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'nombre', 'categoria', 'descripcion', 'fecha', 'ubicacion', 'id_proveedor', 'imagen'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }


}
