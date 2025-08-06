<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'carte_identite_recto',
        'carte_identite_verso',
        'situation_matrimoniale',
        'nationalite',
    
    ];

    protected $casts = [
        'date_naissance' => 'date'
    ];

    public function contratDeBails()
    {
        return $this->hasMany(ContratDeBail::class);
    }
}