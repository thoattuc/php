@extends('layouts.layout')

@section('main')
<!-- Modal Edit User -->
    <div class="modal" id="editUserModal">
        <div class="modal-dialog">
            <div class="modal-content border-none">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa thông tin tài khoản</h4>
                    <button type="button" class="close border-none" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form class="userForm">
                        <div class="form-group">
                            <label for="username">Tên tài khoản:</label>
                            <input type="text" class="form-control  border-none" id="username" value="" name="username"
                                   placeholder="Tên tài khoản" required>
                            <label for="email">Email:</label>
                            <input type="text" class="form-control  border-none" id="email" value="" name="email"
                                   placeholder="Email" required>
                        </div>
                        <button type="submit" class="btn btn-primary border-none" id="submitEditBtn">Sửa</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-none" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Create User -->
    <div class="modal" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content border-none">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Quản lý tài khoản</h4>
                    <button type="button" class="close border-none" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form class="userForm">
                        <div class="form-group">
                            <label for="newUsername">Tên tài khoản:</label>
                            <input type="text" class="form-control  border-none" id="newUsername" value="" name="username"
                                   placeholder="Tên tài khoản" required>
                            <label for="newEmail">Email:</label>
                            <input type="text" class="form-control  border-none" id="newEmail" value="" name="email"
                                   placeholder="Email" required>
                            <label for="userRoleSelect">Loại tài khoản:</label>
                            <select name="idRole" id="userRoleSelect" class="border-none form-control">
                                @foreach($roles as $value)
                                    <option value="{{$value -> id}}">{{$value -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary border-none" id="submitUserBtn">Thêm</button>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-none" data-dismiss="modal">Đóng</button>
                </div>

            </div>
        </div>
    </div>

<!-- Table Content -->

    <div class="table-responsive">
        <h2>Danh sách các tài khoản:</h2>
        <table class="table table-secondary">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên tài khoản</th>
                <th scope="col">Tên loại</th>
                <th scope="col">Email</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $item)
                <tr class="">
                    <th scope="row">{{++$key}}</th>
                    <td><span class="editUserName" data-id="{{$item -> idUser}}">{{$item -> username}}</span></td>
                    <td>
                        <label for="{{$item->idUser}}">
                            <select data-id="{{$item->idUser}}" id="{{$item->idUser}}" class="editUserRole border-none">
                                @foreach($roles as $value)
                                    <option value="{{$value-> id}}">{{$value -> name}}</option>
                                @endforeach
                            </select>
                        </label>
                    </td>
                    <td><span class="pointer editEmail" data-id="{{$item -> idUser}}">{{$item -> email}}</span></td>
                    <td>
                        <label for="{{$item->idUser}}"></label>
                        <select data-id="{{$item->idUser}}" id="{{$item->idUser}}" class="editUserStatus border-none">
                            <option value="1" {{ $item->status ? 'selected' : '' }}>Đang mở</option>
                            <option value="0" {{ $item->status ? '' : 'selected' }}>Đang khóa</option>
                        </select>
                    </td>
                    <td><span>{{$item -> created_at}}</span></td>
                    <td>
                        <button class="deleteUser btn btn-danger border-none" data-id="{{$item->idUser}}">Xóa</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <script>

        $(document).ready(function() {
            addUser();
            editUserRole();
            switchUserStatus();
            editUserName();
            updateEmail();
            deleteUser();
        });

        function deleteUser() {
            $(".deleteUser").click(function (e) {
                e.preventDefault();
                const id = $(this).attr("data-id");
                Swal.fire({
                    icon: "question",
                    title: "Xóa tài khoản này ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Xóa",
                    denyButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/deleteUser",
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
                                    const errorMsg = res.msg.id || res.msg;
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

        function updateEmail() {
            $('.editEmail').click(function (e) {
                e.preventDefault();
                const id = $(this).attr('data-id')
                const old = $(this).text();

                $('#email').val(old);
                $('#editUserModal').modal('show');
                $('#username').hide();

                $('#submitEditBtn').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const emailNew = $('#email').val().trim();

                    if (emailNew === '') {
                        showToastError('Thiếu email');
                    } else if (emailNew === old) {
                        showToastError('Trùng lặp email');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/updateEmail',
                            data: {
                                id: id,
                                email: emailNew
                            },
                            dataType: 'json',
                            success: (function (res) {
                                if (res.check === true) {
                                    showToastSuccess('Thay đổi thành công');
                                    window.location.reload();
                                } else {
                                    const errorMsg = res.msg.id || res.msg.email || "Có lỗi xảy ra";
                                    showToastError(errorMsg);
                                }
                            }),
                            error: function () {
                                showToastError('Có lỗi xảy ra trong quá trính xử lý yêu cầu');
                            }
                        })
                    }
                })




                // alert(oldEmail);
            })
        }

        function editUserName() {
            $('.editUserName').click(function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                const old = $(this).text();

                $('#username').val(old);
                $('#editUserModal').modal('show');
                $('#email').hide();

                $('#submitEditBtn').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const nameNew = $('#username').val().trim();

                    if (nameNew === '') {
                        showToastError('Thiếu tên tài khoản');
                    } else if (nameNew === old) {
                        showToastError('Trùng lặp tên tài khoản');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/updateUserName',
                            data: {
                                id: id,
                                name: nameNew,
                            },
                            dataType: 'json',
                            success: (function (res) {
                                if (res.check === true) {
                                    showToastSuccess('Thay đổi thành công');
                                    window.location.reload();
                                } else {
                                    const errorMsg = res.msg.id || res.msg.name || "Có lỗi xảy ra";
                                    showToastError(errorMsg);
                                }
                            }),
                            error: function () {
                                showToastError('Có lỗi xảy ra trong quá trính xử lý yêu cầu');
                            }
                        })
                    }
                })
            })
        }

        function switchUserStatus() {
            $('.editUserStatus').change(function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                const status = $(this).val();
                console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: '/switchUserStatus',
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: 'json',
                    success : (function(res) {
                        if (res.check === true) {
                            showToastSuccess('Thay đổi trạng thái tài khoản thành công');
                            window.location.reload();
                        } else {
                            if(res.msg.id) {
                                showToastError(res.msg.id);
                            } else if(res.msg.status) {
                                showToastError(res.msg.status);
                            }
                        }
                    }),
                    error : (function () {
                        showToastError('Có lỗi xảy ra trong quá trình xử lý yêu cầu');
                    })
                })
            })
        }

        function editUserRole() {
            $('.editUserRole').change(function (e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                const idRole = $(this).val();
                console.log(id, idRole);
                $.ajax({
                    type: 'POST',
                    url: "/updateUserRole",
                    data: {
                        id: id,
                        idRole: idRole
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.check === true) {
                            showToastSuccess("Thay đổi loại tài khoản thành công");
                            window.location.reload();
                        } else {
                            if (res.msg.id) {
                                showToastError(res.msg.id);
                            } else if (res.msg.idRole) {
                                showToastError(res.msg.idRole);
                            }
                        }
                    }
                });
            });
        }

        function addUser() {
            $('#addUserBtn').click(function (e) {
                e.preventDefault();
                $('#userModal').modal('show');
            });

            $('#submitUserBtn').click(function (e) {
                e.preventDefault();
                handleFormSubmission();
            });

            function handleFormSubmission() {
                const name = $('#newUsername').val().trim();
                const email = $('#newEmail').val().trim();
                const idRole = $('#userRoleSelect').val();

                console.log(name, email, idRole);

                if (name === '') {
                    showToastError("Thiếu tên tài khoản");
                } else if (email === '') {
                    showToastError("Thiếu email tài khoản");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/createUser",
                        data: {
                            name: name,
                            email: email,
                            idRole: idRole
                        },
                        dataType: "json",
                        success: function (res) {
                            if (res.check === true) {
                                showToastSuccess("Thêm tài khoản thành công");
                                window.location.reload();
                            } else {
                                if (res.msg.name) {
                                    showToastError(res.msg.name);
                                } else if (res.msg.email) {
                                    showToastError(res.msg.email);
                                } else if (res.msg.idRole) {
                                    showToastError(res.msg.idRole);
                                }
                            }
                        }
                    });
                }
            }
        }



        function showToastError(title) {
            Toast.fire({
                icon: "error",
                title: title
            });
        }

        function showToastSuccess(title) {
            Toast.fire({
                icon: "success",
                title: title
            });
        }
    </script>
@endsection

@section('btn')
    <button type="button" class="btn btn-secondary border-none" id="addUserBtn">
        Thêm
    </button>
@endsection
