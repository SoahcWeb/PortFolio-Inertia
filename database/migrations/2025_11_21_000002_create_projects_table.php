<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('main_image')->nullable(); // image principale
            $table->json('gallery')->nullable();      // galerie
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_highlighted')->default(false);
            $table->timestamps();
        });

        // Table pivot pour technologies (Many-to-Many)
        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_technology');
        Schema::dropIfExists('projects');
    }
}
