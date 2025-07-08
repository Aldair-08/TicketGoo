<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'evento_id', 'promocion_id', 'total', 'estado', 'formato_entrega', 'fecha_pago'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_pago' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($compra) {
            $compra->created_at = now()->setTimezone('America/Lima');
            $compra->updated_at = now()->setTimezone('America/Lima');
        });
        
        static::updating(function ($compra) {
            $compra->updated_at = now()->setTimezone('America/Lima');
        });
    }

    // Relación con CompraDetalle
    public function detalles()
    {
        return $this->hasMany(CompraDetalle::class, 'compra_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id_evento');
    }

    // Relación con Promocion
    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'promocion_id', 'id_promocion');
    }

    // Método para obtener la fecha de compra formateada
    public function getFechaCompraFormateadaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}
