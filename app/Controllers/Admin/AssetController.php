<?php

namespace MovieChill\app\Controllers\Admin;

use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function index()
    {
        return view('admin.pages.asset.index');
    }
}
