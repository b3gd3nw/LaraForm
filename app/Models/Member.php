<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
