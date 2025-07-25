<?php

namespace MovieChill\app\Controllers\Admin;

use App\Http\Controllers\Controller;
use MovieChill\app\Models\User;
use MovieChill\Infrastructure\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function show($id)
    {
        return view('admin.pages.user.show');
    }

    public function update(Request $request)
    {
        $response['url_return'] = route('user.show', ['id' => $request->get('id')]);

        try {
            $param = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'spending_limit' => $request->get('spending_limit'),
            ];
            User::query()->where('id', $request->get('id'))->update($param);

            return ResponseHelper::sendResponse(Response::HTTP_OK, "Cập nhật thành công", $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseHelper::sendResponse(Response::HTTP_BAD_REQUEST, "Cập nhật thất bại", $response);
        }
    }
}
