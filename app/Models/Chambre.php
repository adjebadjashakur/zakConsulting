<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_chambre',
        'type',
        'loyer_individuel',
        'caution',
        'statut',
        'maison_id',
    ];

    /**
     * Relation : Une chambre appartient à une maison
     */
    public function maison()
    {
        return $this->belongsTo(Maison::class);
    }
    
    public function locataire()
    {
    return $this->belongsTo(Locataire::class);
    }
    public function contratDeBail()
    {
        return $this->hasOne(ContratDeBail::class);
    }
}