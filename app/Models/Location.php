<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $table = 'location';

    protected $fillable = [
        'id',
        'name',
        'description',
        'currency',
        'value',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_location', 'location_id', 'user_id');
    }
}
