<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $dates = ['date'];

    protected $fillable = ['name',
        'date',
        'starting_price',
        'desc',
        'operator_id'
    ];

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
