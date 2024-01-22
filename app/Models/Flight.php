<?php

namespace App\Models;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
    ];
    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }
}
