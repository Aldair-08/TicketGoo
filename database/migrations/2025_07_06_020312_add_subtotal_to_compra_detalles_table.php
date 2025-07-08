<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('compra_detalles', function (Blueprint $table) {
            // Verificar si la columna subtotal ya existe antes de agregarla
            if (!Schema::hasColumn('compra_detalles', 'subtotal')) {
                $table->decimal('subtotal', 8, 2)->after('precio_unitario');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_detalles', function (Blueprint $table) {
            // Verificar si la columna existe antes de eliminarla
            if (Schema::hasColumn('compra_detalles', 'subtotal')) {
                $table->dropColumn('subtotal');
            }
        });
    }
};
