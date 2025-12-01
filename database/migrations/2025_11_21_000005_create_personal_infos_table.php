<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('job_title')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('photo')->nullable(); // Avatar / photo
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('x')->nullable(); // ancien twitter
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
};
