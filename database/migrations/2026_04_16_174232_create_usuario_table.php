<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nombre');
            $table->date('fechanacimiento');
            $table->string('telefono');
            $table->date('fechaingreso');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('usuario');
    }
};