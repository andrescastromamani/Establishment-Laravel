<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'image', 'direction', 'suburb', 'lat', 'lng', 'phone', 'description', 'open_time', 'close_time', 'uuid', 'user_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
