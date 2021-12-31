<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProdcut extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'prodcut_id', 'quantity'];

    public function prodcuts()
    {
        return $this->belongsToMany(Prodcut::class)->withPivot('quantity');
    }
}
