<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario_planilla', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuidplanilla'); 
            $table->uuid('uuidusuario');  
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('uuidplanilla')->references('uuid')->on('planilla')->onDelete('cascade');
            $table->foreign('uuidusuario')->references('uuid')->on('usuario')->onDelete('cascade');
        }); 
    } 

    public function down(): void {
        Schema::dropIfExists('usuario_planilla');
    }
};