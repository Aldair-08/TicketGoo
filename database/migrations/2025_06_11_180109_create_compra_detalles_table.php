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
        Schema::create('compra_detalles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('compra_id');
        $table->string('tipo_ticket'); // VIP, Preferencial, General
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 8, 2);
        $table->timestamps();

        $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_detalles');
    }
};
