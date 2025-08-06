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
        'proprietaire_id'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'commission' => 'decimal:2',
        'total_net' => 'decimal:2',
        'date_rapport' => 'date'
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }
}
