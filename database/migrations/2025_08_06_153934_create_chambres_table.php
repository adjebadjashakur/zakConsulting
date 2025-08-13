<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('code_chambre')->unique(); 
            $table->string('type')->nullable(); 
            $table->decimal('loyer_individuel')->nullable(); 
            $table->decimal('caution')->nullable();
            $table->enum('statut', ['libre', 'occupé', 'maintenance'])->default('libre');
            $table->foreignId('maison_id')->constrained('maisons')->onDelete('cascade');
            $table->foreignId('locataire_id')->nullable()->constrained('locataires')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};