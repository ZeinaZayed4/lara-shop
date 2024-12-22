<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_status',
        'payment_method',
        'address',
        'notes',
        'subtotal',
        'vat',
        'total',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relations
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'price', 'total']);
    }

    public function orders()
    {
        return $this->hasMany('orders');
    }
}
