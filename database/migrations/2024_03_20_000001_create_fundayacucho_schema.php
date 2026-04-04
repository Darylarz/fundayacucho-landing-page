<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       /* Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        }); */

       /* Schema::create('invitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        }); */

       /* Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('image_path');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        }); 

        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_image_path');
            $table->string('pdf_file_path');
            $table->timestamps();
        }); */

       /* Schema::create('informaciones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_path');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        }); */

      /*  Schema::create('site_configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable(local);
            $table->string('cintillo_path')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        }); */
    }

    public function down(): void
    {
        Schema::dropIfExists('site_configs');
        Schema::dropIfExists('informaciones');
        Schema::dropIfExists('libros');
        Schema::dropIfExists('noticias');
        Schema::dropIfExists('invitaciones');
        Schema::dropIfExists('carousel_slides');
    }
};
