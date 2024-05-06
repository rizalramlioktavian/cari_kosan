<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ruang_id',
        'promo_id',
        'name',
        'phone',
        'email',
        'payment_method',
        'tanggal_sewa',
        'total_sewa',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promo_id', 'id');
    }
}
