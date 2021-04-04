<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $dates = ['receipt_at', 'done_at'];
    protected $fillable = ['item_id', 'people_id', 'operator_id', 'address', 'receipt', 'status', 'courier', 'receipt_at', 'done_at'];

    public function registerMediaCollections(): void
    {
        $this
        ->addMediaCollection('checkout')
        ->singleFile();
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
