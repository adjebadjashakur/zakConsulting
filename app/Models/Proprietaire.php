<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'carte_identite_recto',
        'carte_identite_verso',
        'adresse',
        'commune'
    ];

    public function maisons()
    {
        return $this->hasMany(Maison::class);
    }

    public function rapportImmobiliers()
    {
        return $this->hasMany(RapportImmobilier::class);
    }
    public function contratDeBail()
    {
        return $this->hasOne(ContratDeBail::class);
    }
}