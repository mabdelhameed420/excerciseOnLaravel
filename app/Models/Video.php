<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'id',
        'name',
        'discreption',
        'count',
        'updated_at',
    ];

    protected $hidden = [];

    public $timestamps = false;
}
