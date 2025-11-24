<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // Poste
            $table->string('company');          // Entreprise
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL = en cours
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->string('logo')->nullable();    // Logo de l’entreprise
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
