<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_types';

    public function transform()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price_per_hour' => $this->price_per_hour,
            'price_per_day' => $this->price_per_day,
        ];  
    }
}
