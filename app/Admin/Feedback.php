<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Feedback extends Model
{
    protected $fillable = ['email','testimonial','user_id','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
