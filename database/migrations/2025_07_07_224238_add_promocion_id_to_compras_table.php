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
            $table->unsignedBigInteger('promocion_id')->nullable()->after('evento_id');
            $table->foreign('promocion_id')->references('id_promocion')->on('promociones')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['promocion_id']);
            $table->dropColumn('promocion_id');
        });
    }
};
