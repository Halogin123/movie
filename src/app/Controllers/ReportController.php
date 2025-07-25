<?php

namespace Ducnm\app\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sendReport(Request $request)
    {
        \Log::warning("report: " . $request->report);
        return redirect()->route('dashboard');
    }
}
