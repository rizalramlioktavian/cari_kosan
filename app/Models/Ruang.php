<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'kosan_id',
        'picture',
        'title',
        'slug',
        'price',
        'total_ruang',
        'type_sewa',
        'ruang_facility',
    ];

    public function kosan()
    {
        return $this->belongsTo(Kosan::class, 'kosan_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'ruang_id', 'id');
    }
}
