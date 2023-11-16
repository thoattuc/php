<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRoleModel $userRoleModel)
    {
        //
    }
}
