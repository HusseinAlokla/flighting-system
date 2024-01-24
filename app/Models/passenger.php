<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class passenger extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [
        'FirstName',
        'LastName',
        'email',
        'password',
        'DOB',
        'passport_expiry_date'
    ];
    // Passenger model
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

}
