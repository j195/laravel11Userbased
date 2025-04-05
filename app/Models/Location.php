<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['main_user_id', 'city', 'country'];

    public function user()
    {
        return $this->belongsTo(MainUser::class, 'main_user_id');
    }
}
