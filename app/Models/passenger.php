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
    protected $guarded = [];

    public function flight()
    {
        return $this->belongsToMany(Flight::class);
    }

}
