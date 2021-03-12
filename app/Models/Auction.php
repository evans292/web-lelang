<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function bid()
    {
        return $this->hasOne(Bid::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
