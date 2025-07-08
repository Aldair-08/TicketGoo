<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Proveedor;
use App\Models\Evento;
use App\Models\Promocion;
use App\Models\Carrusel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Crear administrador
        Admin::create([
            'name' => 'Administrador',
            'email' => 'admin@ticketgoo.com',
            'password' => Hash::make('admin123'),
        ]);

        // Crear proveedores de ejemplo
        Proveedor::create([
            'nombre' => 'Producciones Musicales S.A.',
            'email' => 'contacto@produccionesmusicales.com',
            'telefono' => '+51 999 888 777',
            'direccion' => 'Av. Arequipa 123, Lima',
            'descripcion' => 'Empresa especializada en producción de eventos musicales',
        ]);

        Proveedor::create([
            'nombre' => 'Teatro Nacional',
            'email' => 'info@teatronacional.com',
            'telefono' => '+51 999 777 666',
            'direccion' => 'Jr. Huancavelica 456, Lima',
            'descripcion' => 'Teatro histórico con más de 100 años de tradición',
        ]);

        // Crear eventos de ejemplo
        Evento::create([
            'nombre' => 'Concierto de Rock Nacional',
            'categoria' => 'Conciertos',
            'descripcion' => 'Gran concierto con las mejores bandas de rock nacional',
            'fecha' => '2025-08-15 20:00:00',
            'ubicacion' => 'Estadio Nacional',
            'imagen' => 'concierto-rock.jpg',
            'imagen_fondo' => 'fondo-concierto.jpg',
            'proveedor_id' => 1,
            'publicado' => true,
        ]);

        Evento::create([
            'nombre' => 'Obra de Teatro Clásica',
            'categoria' => 'Teatro',
            'descripcion' => 'Presentación de una obra clásica de Shakespeare',
            'fecha' => '2025-08-20 19:30:00',
            'ubicacion' => 'Teatro Canout',
            'imagen' => 'teatro-clasico.jpg',
            'imagen_fondo' => 'fondo-teatro.jpg',
            'proveedor_id' => 2,
            'publicado' => true,
        ]);

        // Crear promociones de ejemplo
        Promocion::create([
            'codigo' => 'DESCUENTO20',
            'descripcion' => '20% de descuento en todas las entradas',
            'descuento' => 20,
            'fecha_inicio' => '2025-07-01',
            'fecha_fin' => '2025-08-31',
            'activo' => true,
        ]);

        // Crear carrusel de ejemplo
        Carrusel::create([
            'titulo' => 'Bienvenido a TicketGoo',
            'descripcion' => 'La mejor plataforma para comprar entradas de eventos',
            'imagen' => 'banner-principal.jpg',
            'activo' => true,
            'orden' => 1,
        ]);
    }
}
