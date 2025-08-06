<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'quartier',
        'superficie',
        'description',
        'loyer_mensuel',
        'statut',
        'proprietaire_id'
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

    public function contratDeBails()
    {
        return $this->hasMany(ContratDeBail::class);
    }
}