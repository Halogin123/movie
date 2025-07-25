<?php

namespace Ducnm\app\Controllers\Admin;


use Ducnm\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class GroupPermissionController
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.pages.group-permission.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.pages.group-permission.create');
    }

    public function store(Request $request)
    {
        $response = [];
        $validate =  Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ], [
            'name.required' => 'Tên là trường bắt buộc',
        ]);

        if ($validate->fails()) {
            return ResponseHelper::sendResponse(Response::HTTP_BAD_REQUEST, $validate->errors());
        }

        DB::beginTransaction();
        try {
            $permission = Role::create([
                'name' => $request->get('name'),
                'guard_name' => 'web'
            ]);
            DB::commit();
            $response['url_return'] = route('group-permission.index');
            return ResponseHelper::sendResponse(Response::HTTP_OK, $response);
        } catch (\Exception $e) {
            DB::rollback();
            $response['url_return'] = route('group-permission.index');
            return ResponseHelper::sendResponse(Response::HTTP_BAD_REQUEST, $e->getMessage(), $response);
        }
    }
}
