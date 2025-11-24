<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');                 // Nom du projet
            $table->string('subtitle')->nullable();  // Sous-titre optionnel
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // Image principale
            $table->string('url')->nullable();       // Lien live
            $table->string('github')->nullable();    // Lien repo
            $table->json('technologies')->nullable();// JSON : liste de technologies
            $table->boolean('is_highlighted')->default(false); // Mise en avant ?
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
