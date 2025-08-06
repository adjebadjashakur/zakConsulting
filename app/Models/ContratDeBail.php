<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratDeBail extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'pdf',
        'loyer_mensuel',
        'caution',
        'statut',
        'locataire_id',
        'maison_id'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'loyer_mensuel' => 'decimal:2',
        'caution' => 'decimal:2'
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    public function maison()
    {
        return $this->belongsTo(Maison::class);
    }
}
