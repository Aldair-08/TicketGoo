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
        Schema::create('promociones', function (Blueprint $table) {
            $table->bigIncrements('id_promocion');
            $table->string('nombre');
            $table->enum('tipo', ['PORCENTAJE', 'MONTO', '2x1']);
            $table->decimal('valor', 8, 2)->default(0.00);
            $table->unsignedBigInteger('id_evento');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamps();

            $table->foreign('id_evento')->references('id_evento')->on('eventos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
