<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trajet extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

}
