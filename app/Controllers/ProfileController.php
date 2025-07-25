<?php

namespace Ducnm\app\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('Profile.Ducnm.index');
    }

    public function nhungNVH(): View
    {
        return view('Profile.Nhungnvh.index');
    }
}
