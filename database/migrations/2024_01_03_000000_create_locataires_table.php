<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locataires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('carte_identite_recto')->nullable();
            $table->string('carte_identite_verso')->nullable();
            $table->string('situation_matrimoniale')->nullable(); // Célibataire, marié, etc.
            $table->string('nationalite')->default('Togolaise');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locataires');
    }
};