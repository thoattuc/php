<?php

namespace App\Http\Controllers;

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
        $roles = UserRoleModel::where('status', 1) -> select('id', 'name') -> get();
//        dd($roles);
        return view('users.users', compact('roles'));
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
            'idRole.required' => 'Mã loại tài khoản không hợp lệ',
            'idRole.exists' => 'Mã loại tài khoản không hợp lệ'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        $password = random_int(100000,999999);
        $hash = Hash::make($password);

        UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'idRole' => $request->idRole,
            'password' => $hash,
            ]);

        // Gửi email:
//        $mailData = [
//            'title' => 'Email từ dự án Thoattuc Laravel',
//            'body' => 'Tài khoản được tạo thành công',
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password
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
    public function destroy(UserModel $userModel)
    {
        //
    }
}
