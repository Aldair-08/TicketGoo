<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraDetalle extends Model
{
    use HasFactory;

    protected $table = 'compra_detalles'; // nombre de la tabla en BD

    protected $fillable = [
        'compra_id',
        'tipo_ticket',
        'cantidad',
        'precio_unitario',
    ];

    // Relación inversa con Compra
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
}
