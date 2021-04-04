<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    
    protected $dates = ['birthdate'];
    protected $fillable = ['user_id',
        'name',
        'birthdate',
        'gender',
        'address',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
}
