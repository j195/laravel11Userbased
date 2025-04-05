<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['main_user_id', 'gender'];

    public function user()
    {
        return $this->belongsTo(MainUser::class, 'main_user_id');
    }
}
