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
        Schema::table('compras', function (Blueprint $table) {
            // Verificar si la columna evento_id ya existe antes de agregarla
            if (!Schema::hasColumn('compras', 'evento_id')) {
                $table->unsignedBigInteger('evento_id')->nullable()->after('usuario_id');
                $table->foreign('evento_id')->references('id_evento')->on('eventos')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compras', function (Blueprint $table) {
            // Verificar si la columna existe antes de eliminarla
            if (Schema::hasColumn('compras', 'evento_id')) {
                $table->dropForeign(['evento_id']);
                $table->dropColumn('evento_id');
            }
        });
    }
};
