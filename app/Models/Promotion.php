<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'picture',
        'title',
        'discount',
        'status',
    ];

    public function order()
    {
        return $this->hasMany(Order::class,'promo_id','id');
    }
}
