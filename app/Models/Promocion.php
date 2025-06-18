<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';

    protected $primaryKey = 'id_promocion';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'descuento',
        'estado',
        'id_evento', // Agrega esto si tu promoción está asociada a un evento
    ];

    /**
     * Relación: una promoción pertenece a un evento.
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }

    /**
     * (Opcional) Relación con proveedor, si aplica.
     * Elimínalo si las promociones no dependen directamente del proveedor.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
