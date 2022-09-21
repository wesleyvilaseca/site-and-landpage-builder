<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebSiteStoreUpdate;
use App\Models\Page;
use App\Models\WebSite;
use Illuminate\Http\Request;

class WebSiteController extends Controller
{
    public function index()
    {
        $data['title']              = 'WebSites';
        $data['toptitle']           = 'WebSites';
        $data['breadcrumb'][]       = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]       = (object)['route' => '#', 'title' => 'WebSites', 'active' => true];
        $data['list']               = WebSite::where('user_id', auth()->user()->id)->get();
        $data['web']                = true;
        $data['webs']               = true;

        return view('admin.website.index', $data);
    }

    public function create()
    {
        $data['title']              = 'WebSites';
        $data['toptitle']           = 'WebSites';
        $data['breadcrumb'][]       = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]       = (object)['route' => route('websites'), 'title' => 'WebSites'];
        $data['breadcrumb'][]       = (object)['route' => '#', 'title' => 'Novo WebSite', 'active' => true];
        $data['action']             = route('websites.store');
        $data['web']                = true;
        $data['webs']               = true;

        return view('admin.website.create', $data);
    }

    public function edit($id)
    {
        $website = WebSite::where(['id' => $id, 'user_id' => auth()->user()->id])->first();
        if (!$website) return redirect()->back()->with('error', 'operação não autorizada');

        $data['title']              = 'WebSites';
        $data['toptitle']           = 'WebSites';
        $data['breadcrumb'][]       = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]       = (object)['route' => route('websites'), 'title' => 'WebSites'];
        $data['breadcrumb'][]       = (object)['route' => '#', 'title' => 'Editar WebSite ' . $website->title, 'active' => true];
        $data['website']            = $website;
        $data['action']             = route('websites.update', $website->id);
        $data['web']                = true;
        $data['webs']               = true;

        return view('admin.website.create', $data);
    }

    public function store(WebSiteStoreUpdate $request)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = auth()->user()->id;

        $result = WebSite::create($data);

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('websites')->with('success', 'WebSite criado com sucesso');
    }

    public function update(WebSiteStoreUpdate $request, $id)
    {
        $website = WebSite::where(['id' => $id, 'user_id' => auth()->user()->id])->first();

        if (!$website) return redirect()->back()->with('erro', 'operação não autorizada');

        $data = $request->except(['_token']);

        $result = WebSite::where(['id' => $id, 'user_id' => auth()->user()->id])->update($data);

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('websites')->with('success', 'WebSite editado com sucesso');
    }

    public function delete($id)
    {
        $website = WebSite::where(['id' => $id, 'user_id' => auth()->user()->id])->first();

        if (!$website) return redirect()->back()->with('erro', 'operação não autorizada');

        $result = $website->delete();

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('websites')->with('success', 'WebSite removido com sucesso');
    }
}
