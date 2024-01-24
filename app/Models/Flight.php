<?php

namespace App\Models;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
