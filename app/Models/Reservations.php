<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function passager()
    {
        return $this->belongsTo(Passager::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
