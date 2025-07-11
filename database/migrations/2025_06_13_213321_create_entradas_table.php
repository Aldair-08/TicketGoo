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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id');
            $table->string('tipo'); // VIP, GENERAL, PREFERENCIAL
            $table->decimal('precio', 8, 2);
            $table->integer('stock');
            $table->integer('ticket_por_persona');
            $table->timestamps();

            $table->foreign('evento_id')->references('id_evento')->on('eventos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
