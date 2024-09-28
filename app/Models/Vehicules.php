<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
