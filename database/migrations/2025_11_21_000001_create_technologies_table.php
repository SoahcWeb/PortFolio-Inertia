<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();

            // Nom unique (obligatoire)
            $table->string('name')->unique();

            // Couleur HEX (#rrggbb)
            $table->string('color', 7)->default('#000000');

            // Ordre d’affichage
            $table->integer('order')->default(0);

            // Logo uploadé (storage/app/public/logos)
            $table->string('logo_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('technologies');
    }
};
