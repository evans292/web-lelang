<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['item_id', 'people_id', 'address', 'receipt', 'status'];

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
}
