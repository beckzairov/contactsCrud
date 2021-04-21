<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;
use App\Models\Phone;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function email()
    {
        return $this->hasMany(Email::class, 'id');
    }

    public function phone()
    {
        return $this->hasMany(Phone::class, 'id');
    }
}
