<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id_evento'); // ID personalizado

            $table->string('nombre');
            $table->string('categoria'); // Concierto, Teatro, etc.
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->string('ubicacion');
            $table->string('imagen')->nullable(); // ruta imagen

            $table->unsignedBigInteger('id_proveedor');

            // Relaciones
            $table->foreign('id_proveedor')
                ->references('id_proveedor')
                ->on('proveedores')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
