<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrat_de_bails', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('pdf')->nullable();
            $table->decimal('loyer');
            $table->decimal('caution');
            $table->enum('statut', ['actif', 'suspendu', 'inactif'])->default('actif');
            $table->foreignId('locataire_id')->constrained('locataires')->onDelete('cascade');
            $table->foreignId('maison_id')->constrained('maisons')->onDelete('cascade');
            $table->foreignId('chambre_id')->nullable()->constrained('chambres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrat_de_bails');
    }
};