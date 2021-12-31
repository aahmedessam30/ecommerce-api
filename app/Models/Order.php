<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'email', 'address', 'city', 'phone',
        'name_on_card', 'discount', 'subtotal', 'tax', 'total',
        'payment_gateway', 'shipped', 'error'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
