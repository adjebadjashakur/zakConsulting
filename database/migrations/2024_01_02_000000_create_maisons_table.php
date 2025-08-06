<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maisons', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('adresse');
            $table->string('quartier')->nullable();
            $table->string('superficie')->nullable();
            $table->text('description')->nullable();
            $table->decimal('loyer_mensuel')->nullable();
            $table->enum('statut', ['libre', 'occupé', 'maintenance'])->default('libre');
            $table->foreignId('proprietaire_id')->constrained('proprietaires')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maisons');
    }
};