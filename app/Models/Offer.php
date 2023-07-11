<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'id',
        'name_en',
        'name_ar',
        'details_en',
        'details_ar',
        'price',
        'photo',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public $timestamps = false;
}
