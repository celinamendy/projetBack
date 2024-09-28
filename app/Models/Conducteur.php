<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conducteur extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
