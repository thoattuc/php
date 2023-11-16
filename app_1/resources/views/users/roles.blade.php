@extends('layouts.layout')

@section('main')
    <!-- Modal -->
    <div class="modal" id="roleModal">
        <div class="modal-dialog">
            <div class="modal-content border-none">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm loại tài khoản</h4>
                    <button type="button" class="close border-none" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="addUserRoleForm">
                        <div class="form-group">
                            <label for="userRole">Loại tài khoản:</label>
                            <input type="text" class="form-control  border-none" id="userRole" name="userRole" required>
                        </div>
                        <button type="submit" class="btn btn-primary border-none" id="submitRoleBtn">Thêm</button>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-none" data-dismiss="modal">Đóng</button>
                </div>

            </div>
        </div>
    </div>

    <div class="table-responsive">
        <h2>Danh sách các loại tài khoản:</h2>
        <table class="table table-primary">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên loại</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $key => $item)
                <tr class="">
                    <td scope="row">{{++$key}}</td>
                    <td>{{$item -> name}}</td>
                    <td>
                        <label for="status"></label><select name="" id="status" class="border-none">
                            @if ($item -> status==0)
                                <option value="0">Đang khóa</option>
                            @else
                                <option value="1">Đang mở</option>
                            @endif
                        </select>
                    </td>
                    <td>{{$item -> created_at}}</td>
                    <td>
                        <button class="btn btn-danger border-none">Xóa</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $(document).ready(function () {
            addRole();
        });

        function addRole() {
            $('#addRoleBtn').click(function (e) {
                e.preventDefault();
                $('#roleModal').modal('show');
                $('#submitRoleBtn').click(function (e) {
                    e.preventDefault();
                    const rolename = $('#userRole').val().trim();
                    if (rolename === '') {
                        // client
                        Toast.fire({
                            icon: "error",
                            title: "Thiếu tên loại tài khoản!"
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/role",
                            data: {rolename: rolename},
                            dataType: "JSON",
                            success: function (res) {
                                console.log(res);
                                if (res.check === true) {
                                    Toast.fire({
                                        icon: "success",
                                        title: "Thêm thành công"
                                    }).then(() => {
                                        window.location.reload();
                                        console.log("rolename:", rolename);
                                    });
                                }
                                if (res.msg.rolename) {
                                    // server
                                    Toast.fire({
                                        icon: "error",
                                        title: res.msg.rolename
                                    });
                                }
                            },
                        });
                    }
                })
            });
        }
    </script>
@endsection

@section('btn')
    <button type="button" class="btn btn-secondary border-none" id="addRoleBtn">
        Thêm
    </button>
@endsection
