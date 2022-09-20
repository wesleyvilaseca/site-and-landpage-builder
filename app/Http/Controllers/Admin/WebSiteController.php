<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\WebSite;
use Illuminate\Http\Request;

class WebSiteController extends Controller
{
    public function index()
    {
        $data['title']      = 'Anotacoes';
        $data['toptitle']   = 'Anotacoes';
        $data['list']       = WebSite::where('user_id', auth()->user()->id)->get();
        $data['web']        = true;
        $data['webs']       = true;

        return view('admin.website.index', $data);
    }

    public function pages($website_id)
    {
        $data['title']      = 'Anotacoes';
        $data['toptitle']   = 'Anotacoes';
        $data['list']       = Page::where(['website_id' => $website_id])->get();
        $data['web']        = true;
        $data['webs']       = true;

        return view('admin.website.pages', $data);
    }
}
