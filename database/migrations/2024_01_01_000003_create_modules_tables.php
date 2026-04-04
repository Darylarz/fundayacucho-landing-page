<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Invitaciones
        Schema::create('invitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('link');
            $table->string('title')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Libros
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_image_path'); // Portada
            $table->string('pdf_file_path');    // Archivo PDF
            $table->timestamps();
        });

        // Informaciones (Faltante según README)
        Schema::create('informaciones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('icon')->nullable(); // Para iconos de Bootstrap
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitaciones');
        Schema::dropIfExists('libros');
        Schema::dropIfExists('informaciones');
    }
};