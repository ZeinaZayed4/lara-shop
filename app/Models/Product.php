<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'SKU',
    ];
    protected $appends = ['featured_photo'];

    protected function featuredPhoto(): Attribute
    {
        return new Attribute(
            get: function ()
            {
                return $this->photos()->first()
                    ? asset($this->photos()->first()->path)
                    : asset('uploads/products/image.png');
            }
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
        );
    }

    // Events
    protected static function booted()
    {
        static::created(function ($product) {
            $product->SKU = rand(1000, 9999);
            $product->save();
        });
    }

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }
}
