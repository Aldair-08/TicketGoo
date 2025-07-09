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
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'valor',
        'estado',
        'id_evento',
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

    /**
     * Relación: una promoción puede ser usada en múltiples compras
     */
    public function compras()
    {
        return $this->hasMany(Compra::class, 'promocion_id', 'id_promocion');
    }

    /**
     * Verificar si una promoción ya ha sido utilizada por un usuario específico en un evento
     */
    public function haSidoUsadaPorUsuario($usuarioId, $eventoId = null)
    {
        $query = $this->compras()->where('usuario_id', $usuarioId);
        
        if ($eventoId) {
            $query->where('evento_id', $eventoId);
        }
        
        return $query->exists();
    }
}
