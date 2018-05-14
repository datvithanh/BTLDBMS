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
                                    <button class="btn btn-success btn-sm" onClick="openSubmitModal({{$room['id']}})">
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
    var room_idd = 0;

    function openSubmitModal(roid) {
            room_idd = roid;
            $('#modalRegister').modal('show');
            $("#submitModal").css("display", "");
            $("#alertModal").html(
                ""
            );
        }

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        $(document).ready(function () {
            $("#submitModal").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                var name = $('#nameModal').val();
                var email = $('#emailModal').val();
                var phone = $('#phoneModal').val();
                var ok = 0;
                if (name.trim() == "" || email.trim() == "" || phone.trim() == "") ok = 1;

                if (!name || !email || !phone || ok == 1) {
                    $("#alertModal").html(
                        "<div class='alert alert-danger'>Vui lòng nhập đủ thông tin</div>"
                    );
                    return;
                }
                if (!validateEmail(email)) {
                    $("#alertModal").html(
                        "<div class='alert alert-danger'>Vui lòng kiểm tra lại email</div>"
                    );
                    return;
                }
                var message = "Lấy phòng thành công";
                $("#alertModal").html("<div class='alert alert-success'>" + message + "</div>");
                $("#submitModal").css("display", "none");

                var url = "";
                var data = {
                    name: name,
                    email: email,
                    phone: phone,
                    room_id: room_idd,
                    _token: "{{csrf_token()}}"
                };
                console.log(data);
                axios.post("/api/get-room", data)
                    .then(function () {
                    }.bind(this))
                    .catch(function () {
                    }.bind(this));
            });
        });
</script>
@endpush