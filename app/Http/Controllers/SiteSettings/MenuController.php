<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{

    public function index()
    {   
        $data['title']          = 'Menu website ' . session()->get('sitename');
        $data['toptitle']       = 'Menu website ' . session()->get('sitename');
        // $data['breadcrumb'][]   = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        // $data['breadcrumb'][]   = (object)['route' => route('websites'), 'title' => 'WebSites'];
        // $data['breadcrumb'][]   = (object)['route' => '#', 'title' => 'Paginas do website ' . $website->title, 'active' => true];
        $data['list']           =  Menu::where('website_id', session()->get('website_di'))->get();
        $data['men']            = true;

        return view('settings-website.menu.index', $data);
    }
}
