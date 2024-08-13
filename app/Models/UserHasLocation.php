<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasLocation extends Model
{
    use HasFactory;
    public $table = 'user_has_location';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }


}
