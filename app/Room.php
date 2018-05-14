<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function transform()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'room_type' => $this->roomType->transform()
        ];
    }
}
