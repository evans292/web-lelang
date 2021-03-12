<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $dates = ['auction_date'];
    protected $fillable = ['item_id', 'bid_id', 'auction_date', 'final_price', 'operator_id', 'status'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
