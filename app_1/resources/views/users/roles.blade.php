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

        $(document).ready(function() {
            addRole();
        });

        function addRole() {
            $('#addRoleBtn').click(function (e) {
                e.preventDefault();
                $('#roleModal').modal('show');
                $('#submitRoleBtn').click(function (e) {
                    e.preventDefault();
                    const rolename = $('#userRole').val().trim();
                    if(rolename === '') {
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
                            }
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
