<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'countryId',
        'birthdate',
        'phone',
        'reportsubject',
        'email',
        'company',
        'position',
        'aboutme',
        'photo'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
}
