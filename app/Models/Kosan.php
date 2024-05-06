<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'city_id',
        'picture',
        'title',
        'slug',
        'address',
        'price',
        'description',
        'kosan_facility',
        'public_facility',
        'other_facility',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function ruang()
    {
        return $this->hasMany(Ruang::class, 'kosan_id', 'id');
    }

}
