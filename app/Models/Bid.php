<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'people_id', 'bid_price'];

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
