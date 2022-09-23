<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\WebSite;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['h_settings'] = true;
        return view('settings-website.dashboard.index', $data);
    }
}
