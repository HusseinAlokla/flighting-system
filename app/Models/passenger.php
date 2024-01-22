<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class passenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'FirstName',
        'LastName',
        'email',
        'password',
        'DOB',
        'passport_expiry_date'
    ];
    public function flights()
    {
        return $this->belongsToMany(Flight::class);
    }
}
