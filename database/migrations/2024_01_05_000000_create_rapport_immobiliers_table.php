<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapport_immobiliers', function (Blueprint $table) {
            $table->id();
            $table->string('locataire');
            $table->decimal('total', 10, 2);
            $table->decimal('commission', 10, 2);
            $table->decimal('total_net', 10, 2);
            $table->string('mois_annee');
            $table->date('date_rapport');
            $table->foreignId('proprietaire_id')->constrained('proprietaires')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapport_immobiliers');
    }
};
