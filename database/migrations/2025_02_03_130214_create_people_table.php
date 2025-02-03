<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->onDelete('cascade');
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['cast', 'staff', 'creative']);
            $table->json('name');
            $table->string('slug');
            $table->json('role')->nullable();
            $table->json('character_name')->nullable();
            $table->json('bio')->nullable();
            $table->string('photo')->nullable();
            $table->json('social_media')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Hacer el slug único por sitio
            $table->unique(['site_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
