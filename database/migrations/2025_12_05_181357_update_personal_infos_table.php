<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrUpdatePersonalInfosTable extends Migration
{
    public function up(): void
    {
        // Vérifie si la table existe déjà
        if (!Schema::hasTable('personal_infos')) {
            Schema::create('personal_infos', function (Blueprint $table) {
                $table->id();
                $table->string('full_name')->nullable();
                $table->string('job_title')->nullable();
                $table->text('bio')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('location')->nullable();
                $table->string('profile_photo')->nullable(); // Avatar/photo
                $table->string('cv')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('github')->nullable();
                $table->string('availability')->nullable();
                $table->timestamps();
            });
        } else {
            // Si la table existe, on s'assure que les colonnes manquantes soient ajoutées
            Schema::table('personal_infos', function (Blueprint $table) {
                if (!Schema::hasColumn('personal_infos', 'profile_photo')) {
                    $table->string('profile_photo')->nullable()->after('location');
                }
                if (!Schema::hasColumn('personal_infos', 'cv')) {
                    $table->string('cv')->nullable()->after('profile_photo');
                }
                if (!Schema::hasColumn('personal_infos', 'linkedin')) {
                    $table->string('linkedin')->nullable()->after('cv');
                }
                if (!Schema::hasColumn('personal_infos', 'github')) {
                    $table->string('github')->nullable()->after('linkedin');
                }
                if (!Schema::hasColumn('personal_infos', 'availability')) {
                    $table->string('availability')->nullable()->after('github');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
}
