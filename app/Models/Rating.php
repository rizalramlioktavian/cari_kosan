<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kosan_id',
        'stars_rated',
        'comment'
    ];

    // Relasi many to one dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi many to one dengan kosan
    public function kosan()
    {
        return $this->belongsTo(Kosan::class, 'kosan_id', 'id');
    }
}

