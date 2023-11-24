<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Illuminate\Tests\Integration\Routing\fail;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = UserRoleModel::all();
//        dd($roles);
        return view('users.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rolename' => 'required|unique:role_tbl,name',
        ], [
            'rolename.required' => 'Thiếu tên loại tài khoản',
            'rolename.unique' => 'Loại tài khoản đã tồn tại'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        UserRoleModel::create(['name' => $request->rolename]);
        return response()->json(['check' => true]);
    }

    /**
     * Update the status resource in storage.
     */
    public function switch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:role_tbl,id',
            'status' => 'required|numeric|min:0|max:1'
        ], [
            'id.required' => 'Thiếu tên loại tài khoản',
            'id.exists' => 'Mã Loại tài khoản đã tồn tại',
            'status.required' => 'Không có trạng thái tài khoản',
            'status.numeric' => 'Trạng thái tài khoản không hợp lệ',
            'status.min' => 'Trạng thái tài khoản không hợp lệ',
            'status.max' => 'Trạng thái tài khoản không hợp lệ',
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }
        UserRoleModel::where('id', $request->id)->update(['status' => $request->status]);
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
    public function show(UserRoleModel $userRoleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRoleModel $userRoleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRoleModel $userRoleModel)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:role_tbl,id',
            'rolename' => 'required|unique:role_tbl,name',
        ], [
            'rolename.required' => 'Thiếu tên loại tài khoản',
            'rolename.unique' => 'Loại tài khoản đã tồn tại',
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã loại tài khoản không hợp lệ'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        UserRoleModel::where('id', $request->id)->update(['name' => $request->rolename]);
        return response()->json(['check' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, UserRoleModel $userRoleModel)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:role_tbl,id',
        ], [
            'id.required' => 'Thiếu mã tài khoản',
            'id.exists' => 'Mã loại tài khoản không hợp lệ'
        ]);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }

        $check = UserModel::where('idRole', $request -> id) -> count('id');
        if ($check!==0) {
            return response()->json(['check' => false, 'msg' => 'Có tài khoản trong loại tài khoản này']);
        }
        UserRoleModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
