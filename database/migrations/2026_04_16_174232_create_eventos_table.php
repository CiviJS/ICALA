<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('eventos', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->string('descripcion');
            $table->unsignedBigInteger('admin_encargado');
        });
    }

    public function down(): void {
        Schema::dropIfExists('eventos');
    }
};