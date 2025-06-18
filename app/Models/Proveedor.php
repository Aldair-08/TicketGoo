<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'empresa',
        'estado',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_proveedor', 'id_proveedor');
    }
}
