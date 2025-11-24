<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Backend','Frontend','BDD','DevOps','Design']);
            $table->enum('level', ['Débutant','Intermédiaire','Avancé','Expert']);
            $table->string('color')->nullable();
            $table->integer('order')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('technologies');
    }
};
