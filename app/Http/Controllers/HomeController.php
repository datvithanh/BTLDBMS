<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\RoomRenting;
use Carbon\Carbon;
use App\RoomRentingRoom;

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

    public function rooms()
    {
        $this->data['rooms'] = Room::all()->map(function ($room) {
            $data = $room->transform();
            $data['available'] = !(RoomRentingRoom::where('room_id', $room->id)->where('end_time', null)->count() > 0);
            return $data;
        });
        return view('room', $this->data);
    }

    public function getRoom(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 'customer';
            $user->phone = $request->phone;
            $user->password = Hash::make('123456');
            $user->save();
        }
        $room = Room::find($request->room_id);
        $roomRenting = new RoomRenting();
        $roomRenting->user_id = $user->id;
        $roomRenting->staff_id = 2;
        $roomRenting->save();
        $roomRenting->rooms()->attach($request->room_id, [
            "price_per_day" => $room->roomType->price_per_day,
            "price_per_hour" => $room->roomType->price_per_hour,
            "start_time" => Carbon::now()
        ]);
    }

    public function rentings()
    {
        $this->data['room_rentings'] = RoomRenting::all(); 
        return view('renting', $this->data);
    }

    public function addData()
    {
        // for ($i = 1; $i <= 9; ++$i) {
        //     for ($j = 1; $j <= 8; ++$j) {
        //         $room = new Room();
        //         $room->name = 'Tầng ' . $i . ' giường đơn phòng ' . $j;
        //         $room->room_type_id = 1;
        //         $room->code = 'DON' . $i . '0' . $j;
        //         $room->save();
        //     }
        //     for ($j = 1; $j <= 5; ++$j) {
        //         $room = new Room();
        //         $room->name = 'Tầng ' . $i . ' giường đôi phòng ' . $j;
        //         $room->room_type_id = 2;
        //         $room->code = 'DOI' . $i . '0' . $j;
        //         $room->save();
        //     }
        //     for ($j = 1; $j <= 2; ++$j) {
        //         $room = new Room();
        //         $room->name = 'Tầng ' . $i . ' VIP phòng ' . $j;
        //         $room->room_type_id = 3;
        //         $room->code = 'VIP' . $i . '0' . $j;
        //         $room->save();
        //     }
        // }
    }
}
