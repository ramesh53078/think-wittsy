<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $fillable = ['device_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
