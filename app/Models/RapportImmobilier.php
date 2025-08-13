<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportImmobilier extends Model
{
    use HasFactory;

    protected $fillable = [
        'locataire',
        'total',
        'commission',
        'total_net',
        'mois_annee',
        'date_rapport',
        'locataire_id',
        'maison_id',
        'chambre_id',
        'proprietaire_id'
    ];


    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }
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

}