<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company',
        'position',
        'aboutme',
        'photo',
        'memberid',
        'hide'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberid');
    }


}
