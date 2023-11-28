<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ClassScheduleController;
use App\Models\ClassScheduleModel;
use App\Models\ProcessModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Tests\Integration\Queue\Order;
use App\Models\UserRoleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = UserRoleModel::where('status', 1)->select('id', 'name')->get();
        $users = DB::table('users')
            ->join('role_tbl', 'users.idRole', '=', 'role_tbl.id')
            ->select('users.id as idUser', 'users.name as username', 'users.email as email', 'users.status as status', 'users.created_at')
            ->get();
//        dd($users);
        return view('users.users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'idRole' => 'required|exists:role_tbl,id',
        ], [
            'name.required' => 'Thiếu tên tài khoản',
            'email.required' => 'Thiếu email tài khoản',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'idRole.required' => 'Mã loại tài khoản không tồn tại',
            'idRole.exists' => 'Mã loại tài khoản không hợp lệ'
        ]);

        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        $password = random_int(100000, 999999);
        $hash = Hash::make($password);

        UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'idRole' => $request->idRole,
            'password' => $hash,
        ]);

////        Gửi email:
//        $user = UserModel::where('email', $request->email)->first();
//
////        dd($user);
//        if($user) {
//            $mailData = [
//                'title' => 'Email từ dự án [Thoattuc laravel]',
//                'body' => 'Tài khoản được tạo thành công',
//                'name' => $user->name,
//                'email' => $user->email,
//                'password' => $password,
//            ];
//
//            Mail::to($request -> email) -> send(new UserMail($mailData));
//        } else {
//            return response() -> json(['check' => false, 'msg' => 'Chưa gửi được email thông báo']);
//        }

        return response()->json(['check' => true]);
    }

    public function updateUserRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'idRole' => 'required|exists:role_tbl,id',
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã tài khoản không tồn tại',
            'idRole.required' => 'Mã loại tài khoản không hợp lệ',
            'idRole.exists' => 'Mã loại tài khoản không tồn tại'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }
        UserModel::where('id', $request->id)->update(['idRole' => $request->idRole, 'updated_at' => now()]);
        return response()->json(['check' => true]);
    }

    public function switchUserstatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'status' => 'required|numeric|min:0|max:1'
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã tài khoản không tồn tại',
            'status.required' => 'Trạng thái tài khoản không tồn tại',
            'status.numeric' => 'Trạng thái tài khoản không hợp lệ',
            'status.min' => 'Trạng thái tài khoaản không hợp lệ',
            'status.max' => 'Trạng thái tài khoản không hợp lệ'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => true, 'msg' => $validator->error()]);
        }
        UserModel::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(['check' => true]);
    }

    public function updateUserName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'name' => 'required'
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã tài khoản không tồn tại',
            'name.required' => 'Thiếu tên tài khoản'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => true, 'msg' => $validator->error()]);
        }
        UserModel::where('id', $request->id)->update(['name' => $request->name, 'updated_at' => now()]);
        return response()->json(['check' => true]);
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'email' => 'required|email|unique:users,email'
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã tài khoản không tồn tại',
            'email.required' => 'Thiếu tên tài khoản',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => true, 'msg' => $validator->error()]);
        }
        UserModel::where('id', $request->id)->update(['email' => $request->email, 'updated_at' => now()]);

//        // Gửi email:
//        $username = UserModel::where('id', $request -> id) -> value('name');
//
//        $mailData = [
//            'title' => 'Email từ dự án [Thoattuc laravel]',
//            'body' => 'Tài khoản đã được thay đổi email',
//            'name' => $username,
//            'email' => $request->email,
//            'password' => '********'
//        ];
//
//        Mail::to($request -> email) -> send(new UserMail($mailData));

        return response()->json(['check' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, UserModel $userModel)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã loại tài khoản không hợp lệ'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        $check =
            (ClassScheduleModel::where('idTeacher', $request->id)->count('id'))
            +
            (ProcessModel::where('idTeacher', $request->id)->count('id'));
        if ($check !== 0) {
            return response()->json(['check' => false, 'msg' => 'Tài khoản có chứa class schedule hoặc process']);
        }

        UserModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
