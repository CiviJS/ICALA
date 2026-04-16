<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('planilla', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->date('fechacreacion');
            $table->string('id_admin');
            $table->string('tipodeactividad');
        });
    }

    public function down(): void {
        Schema::dropIfExists('planilla');
    }
};