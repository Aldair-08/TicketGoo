<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',
        'fecha',
        'ubicacion',
        'id_proveedor',
        'imagen'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
    public function entradas()
    {
        return $this->hasMany(\App\Models\Entrada::class, 'evento_id', 'id_evento');
    }

    // Método para obtener la fecha del evento formateada
    public function getFechaEventoFormateadaAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha)->format('d/m/Y H:i');
    }
}
