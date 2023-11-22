@extends('layouts.layout')

@section('main')
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
                            <label for="username">Tên tài khoản:</label>
                            <input type="text" class="form-control  border-none" id="username" value="" name="username"
                                   placeholder="Tên tài khoản" required>
                            <label for="email">Email:</label>
                            <input type="text" class="form-control  border-none" id="email" value="" name="email"
                                   placeholder="Email" required>
                            <label for="userRole">Loại tài khoản:</label>
                            <select name="" id="userRole" class="border-none form-control">
                                @foreach($roles as $item)
                                    <option value="{{$item -> id}}">{{$item -> name}}</option>
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

    <script>
        $('#addUserBtn').click(function (e) {
            e.preventDefault();
            $('#userModal').modal('show');
        });

        $('#submitUserBtn').click(function (e) {
            e.preventDefault();
            handleFormSubmission();
        });

        function handleFormSubmission() {
            const name = $('#username').val().trim();
            const email = $('#email').val().trim();
            const idRole = parseInt($('#userRole option:selected').val(), 10);

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
