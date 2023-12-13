<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Location;
class Category extends Model
{
    protected $fillable = ['user_id','location_id','sorting_type','total_packets_sorted','correct_packets_sorted','total_time_taken','packet_types'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
