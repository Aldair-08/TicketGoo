<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'evento_id', 'tipo', 'precio', 'stock', 'ticket_por_persona'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id_evento');
    }
}
