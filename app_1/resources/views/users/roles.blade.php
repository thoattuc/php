@extends('layouts.layout')

@section('main')
    <div class="modal" id="roleModal">
        <div class="modal-dialog">
            <div class="modal-content border-none">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Quản lý loại tài khoản</h4>
                    <button type="button" class="close border-none" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form class="userRoleForm">
                        <div class="form-group">
                            <label for="userRole">Loại tài khoản:</label>
                            <input type="text" class="form-control border-none" id="userRole" value="" name="" required>
                        </div>
                        <button type="submit" class="btn btn-primary border-none" id="submitRoleBtn">Xác nhận</button>
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
                    <th scope="row">{{++$key}}</th>
                    <td><span class="editRoleName" data-id="{{$item -> id}}">{{$item -> name}}</span></td>
                    <td>
                        <label for="{{$item->id}}"></label>
                        <select data-id="{{$item->id}}" id="{{$item->id}}" class="editRoleStatus border-none">
                            <option value="1" {{ $item->status ? 'selected' : '' }}>Đang mở</option>
                            <option value="0" {{ $item->status ? '' : 'selected' }}>Đang khóa</option>
                        </select>
                    </td>
                    <td>{{$item -> created_at}}</td>
                    <td>
                        <button class="deleteRole btn btn-danger border-none" data-id="{{$item->id}}">Xóa</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            addRole();
            editRole();
            switchRole();
            deleteRole();
        });

        // Delete:
        function deleteRole() {
            $(".deleteRole").click(function (e) {
                e.preventDefault();
                const id = $(this).attr("data-id");
                console.log(id);
                Swal.fire({
                    icon: "question",
                    title: "Xóa loại tài khoản này ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Xóa",
                    denyButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/deleteRole/"+id,
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function (res) {
                                if (res.check === true) {
                                    Toast.fire({
                                        icon: "success",
                                        title: "Xóa thành công"
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    const errorMsg = res.msg.id || "Có lỗi xảy ra";
                                    Toast.fire({
                                        icon: "error",
                                        title: errorMsg
                                    });
                                }
                            },
                            error: function () {
                                Toast.fire({
                                    icon: "error",
                                    title: "Có lỗi xảy ra trong quá trình xử lý yêu cầu"
                                });
                            }
                        });
                    } else if (result.isDenied) {
                        //
                    }
                });
            })
        }


        // Edit status:
        function switchRole() {
            $(".editRoleStatus").change(function (e) {
                e.preventDefault();

                const id = $(this).data("id");
                const statusNew = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "/switchRole",
                    data: {
                        id: id,
                        status: statusNew
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.check === true) {
                            Toast.fire({
                                icon: "success",
                                title: "Thay đổi trạng thái thành công"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            const errorMsg = res.msg.id || res.msg.status || "Có lỗi xảy ra";
                            Toast.fire({
                                icon: "error",
                                title: errorMsg
                            });
                        }
                    },
                    error: function () {
                        Toast.fire({
                            icon: "error",
                            title: "Có lỗi xảy ra trong quá trình xử lý yêu cầu"
                        });
                    }
                });

                console.log(statusNew);
            });
        }


        // Update:
        function editRole() {
            $('.editRoleName').click(function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                const old = $(this).text();

                $("#userRole").val(old);
                $('#roleModal').modal('show');

                $('#submitRoleBtn').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const rolenameNew = $('#userRole').val().trim();

                    if (rolenameNew === '') {
                        Toast.fire({
                            icon: "error",
                            title: "Thiếu tên loại tài khoản!"
                        });
                    } else if (rolenameNew === old) {
                        Toast.fire({
                            icon: "error",
                            title: "Trùng lặp tên loại tài khoản!"
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/updateRole",
                            data: {
                                id: id,
                                rolename: rolenameNew
                            },
                            dataType: "json",
                            success: function (res) {
                                console.log(res);

                                if (res.check === true) {
                                    Toast.fire({
                                        icon: "success",
                                        title: "Thay đổi thành công"
                                    }).then(() => {
                                        window.location.reload();
                                        console.log("rolename:", rolenameNew);
                                    });
                                } else {
                                    const errorMsg = res.msg.id || res.msg.rolename || "Có lỗi xảy ra";
                                    Toast.fire({
                                        icon: "error",
                                        title: errorMsg
                                    });
                                }
                            },
                            error: function () {
                                Toast.fire({
                                    icon: "error",
                                    title: "Có lỗi xảy ra trong quá trình xử lý yêu cầu"
                                });
                            }
                        });
                    }
                });
            });
        }


        // Create:
        function addRole() {
            $('#addRoleBtn').click(function (e) {
                e.preventDefault();
                $('#roleModal').modal('show');

                $('#submitRoleBtn').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const rolename = $('#userRole').val().trim();

                    if (rolename === '') {
                        Toast.fire({
                            icon: "error",
                            title: "Thiếu tên loại tài khoản!"
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/createRole",
                            data: {rolename: rolename},
                            dataType: "json",
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
                                } else if (res.msg && res.msg.rolename) {
                                    Toast.fire({
                                        icon: "error",
                                        title: res.msg.rolename
                                    });
                                } else {
                                    Toast.fire({
                                        icon: "error",
                                        title: "Có lỗi xảy ra"
                                    });
                                }
                            },
                            error: function () {
                                Toast.fire({
                                    icon: "error",
                                    title: "Có lỗi xảy ra trong quá trình xử lý yêu cầu"
                                });
                            }
                        });
                    }
                });
            });
        }

    </script>
@endsection

@section('btn')
    <button type="button" class="btn btn-secondary border-none" id="addRoleBtn">
        Thêm
    </button>
@endsection
