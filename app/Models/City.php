<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'title',
        'status',
    ];

    public function kosan()
    {
        return $this->hasMany(Kosan::class, 'city_id', 'id');
    }
}
