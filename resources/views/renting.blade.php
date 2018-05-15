@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách phòng</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th> Mã phòng</th>
                                <th> Tên</th>
                                <th> Loại phòng</th>
                                <th> Giá theo giờ</th>
                                <th> Giá theo ngày</th>
                                <th> Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td> {{$room['code']}} </td>
                                <td> {{$room['name']}} </td>
                                <td> {{$room['room_type']['name']}} </td>
                                <td> {{$room['room_type']['price_per_hour']}}k</td>
                                <td> {{$room['room_type']['price_per_day']}}k</td>
                                <td>
                                    @if($room['available'] == 1)
                                    <button id="btn{{$room['id']}}"class="btn btn-success btn-sm" onClick="openSubmitModal({{$room['id']}})">
                                        Lấy Phòng
                                    </button>
                                    @else
                                    <button class="btn btn-danger btn-sm">
                                        Hết Phòng
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalRegister" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" style="padding-bottom: 0px">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 10px 20px">
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%"
                                   id="nameModal"
                                   type="text"
                                   placeholder="Họ và tên"/>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%"
                                   type="text"
                                   id="phoneModal"
                                   placeholder="Số điện thoại"/>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%"
                                   type="text"
                                   id="emailModal"
                                   placeholder="Email"/>
                        </div>
                        <div id="alertModal"
                             style="font-size: 14px"></div>
                        <button class="btn btn-success" style="width: 100%; margin: 10px; padding: 15px;"
                                id="submitModal">Đăng kí
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
@push('scripts')
<script>
</script>
@endpush