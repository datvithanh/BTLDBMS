<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function addData()
    {   
        for($i = 1; $i<=9; ++$i) {
            for($j = 1; $j<=8; ++$j)
            {
                $room = new Room();
                $room->name = 'Tầng ' . $i . ' giường đơn phòng ' . $j;
                $room->room_type_id = 1;
                $room->code = 'DON' . $i . '0' . $j;
                $room->save();
            }
            for($j = 1; $j<=5; ++$j)
            {
                $room = new Room();
                $room->name = 'Tầng ' . $i . ' giường đôi phòng ' . $j;
                $room->room_type_id = 2;
                $room->code = 'DOI' . $i . '0' . $j;
                $room->save();                
            }
            for($j = 1; $j<=2; ++$j)
            {
                $room = new Room();
                $room->name = 'Tầng ' . $i . ' VIP phòng ' . $j;
                $room->room_type_id = 3;
                $room->code = 'VIP' . $i . '0' . $j;
                $room->save();                
            }
        }
    }
}
