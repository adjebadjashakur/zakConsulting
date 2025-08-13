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
        'loyer',
        'caution',
        'statut',
        'locataire_id',
        'maison_id',
        'chambre_id'
    ];


    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    public function maison()
    {
        return $this->belongsTo(Maison::class);
    }
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }
    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }
    
}