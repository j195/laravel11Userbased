<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainUser extends Model
{
    protected $fillable = ['name', 'email'];

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
