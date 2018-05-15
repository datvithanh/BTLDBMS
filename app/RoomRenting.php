<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRenting extends Model
{
    protected $table = 'room_rentings';

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_renting_room', 'room_renting_id', 'room_id')
            ->withPivot('start_time', 'end_time', 'price_per_day', 'price_per_hour');
    }

    public function goods()
    {
        return $this->belongsToMany(Good::class, 'room_renting_good', 'room_renting_id', 'good_id')
            ->withPivot('quantity', 'price');
    }

    public function services()
    {
        return $this->belongsToMany(Good::class, 'room_renting_service', 'room_renting_id', 'service_id')
            ->withPivot('price');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function transform()
    {
        return [
            'id' => $this->id,
            ''
        ];
    }
}
