<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('status')->default('draft');
            $table->date('date')->nullable();
            $table->string('client')->nullable();
            $table->string('context')->nullable();
            $table->string('role')->nullable();
            $table->string('link')->nullable();
            $table->string('github')->nullable();
            $table->integer('order')->default(0);
            $table->string('main_image')->nullable();
            $table->timestamps();
        });

        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('project_technology');
        Schema::dropIfExists('projects');
    }
};
