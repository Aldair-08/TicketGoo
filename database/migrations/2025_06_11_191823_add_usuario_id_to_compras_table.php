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
        Schema::table('compras', function (Blueprint $table) {
            if (!Schema::hasColumn('compras', 'usuario_id')) {
                $table->bigInteger('usuario_id')->unsigned()->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropColumn('usuario_id');
        });
    }
};
