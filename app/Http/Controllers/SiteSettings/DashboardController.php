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
        $website = WebSite::where(['id' => $request->website_id, 'user_id' => auth()->user()->id])->first();
        if (!$website) return redirect()->back()->with('error', 'operação não autorizada');

        request()->session()->put('website_id', $website->id);
        request()->session()->put('sitename', $website->title);

        $data['website'] = $website;
        $data['h_settings'] = true;

        return view('settings-website.dashboard.index', $data);
    }
}
