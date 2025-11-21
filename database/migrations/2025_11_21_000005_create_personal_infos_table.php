<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->boolean('available')->default(true);
            $table->string('cv')->nullable();
            $table->json('socials')->nullable(); // {linkedin: '', github: '', twitter: ''}
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('personal_infos');
    }
};
