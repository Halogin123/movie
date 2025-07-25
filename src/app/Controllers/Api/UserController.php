<?php

namespace Ducnm\app\Controllers\Api;

use App\Http\Controllers\Controller;
use Ducnm\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return ResponseHelper::sendResponse(Response::HTTP_BAD_REQUEST, "Đăng nhập không thành công");
        }

        $user = Auth::user();

        return ResponseHelper::sendResponse(Response::HTTP_OK, "Đăng nhập thành công", [
            'token' => $user->id
        ]);
    }
}
