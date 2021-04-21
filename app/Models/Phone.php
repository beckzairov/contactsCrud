<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'phone'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'id');
    }
}
