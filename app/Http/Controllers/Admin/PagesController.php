<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreUpdateRequest;
use App\Models\Page;
use App\Models\WebSite;
use Illuminate\Support\Str;


class PagesController extends Controller
{
    /**
     * pages website
     */
    public function index($website_id)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();

        if (!$website) return redirect()->back()->with('error', 'operação não autorizada');

        $data['title']          = 'Paginas do website ' . $website->title;
        $data['toptitle']       = 'Paginas do website ' . $website->title;
        $data['breadcrumb'][]   = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]   = (object)['route' => route('websites'), 'title' => 'WebSites'];
        $data['breadcrumb'][]   = (object)['route' => '#', 'title' => 'Paginas do website ' . $website->title, 'active' => true];
        $data['list']           =  Page::where(['website_id' => $website->id])->get();
        $data['website']        = $website;
        $data['web']            = true;
        $data['webs']           = true;

        return view('admin.website.pages.pages', $data);
    }

    public function create($website_id)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();

        if (!$website) return redirect()->back()->with('error', 'operação não autorizada');

        $data['title']          = 'Paginas do website ' . $website->title;
        $data['toptitle']       = 'Paginas do website ' . $website->title;
        $data['breadcrumb'][]   = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]   = (object)['route' => route('websites'), 'title' => 'WebSites'];
        $data['breadcrumb'][]   = (object)['route' => route('pages', $website->id), 'title' => 'Páginas do website ' . $website->title];
        $data['breadcrumb'][]   = (object)['route' => '#', 'title' => 'Nova página', 'active' => true];
        $data['website']        = $website;
        $data['web']            = true;
        $data['webs']           = true;

        $data['action']         = route('pages.store', $website->id);

        return view('admin.website.pages.create', $data);
    }

    public function edit($website_id, $pageid)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();
        $page = Page::find($pageid);

        if (!$website || !$page) return redirect()->back()->with('error', 'operação não autorizada');

        $data['title']          = 'Paginas do website ' . $website->title;
        $data['toptitle']       = 'Paginas do website ' . $website->title;
        $data['breadcrumb'][]   = (object)['route' => route('painel'), 'title' => 'Painel de controle'];
        $data['breadcrumb'][]   = (object)['route' => route('websites'), 'title' => 'WebSites'];
        $data['breadcrumb'][]   = (object)['route' => route('pages', $website->id), 'title' => 'Páginas do website ' . $website->title];
        $data['breadcrumb'][]   = (object)['route' => '#', 'title' => 'Editar página ' . $page->name, 'active' => true];
        $data['website']        = $website;
        $data['page']           = $page;
        $data['web']            = true;
        $data['webs']           = true;

        $data['action']         = route('pages.update', [$website->id, $page->id]);

        return view('admin.website.pages.create', $data);
    }

    public function store(PageStoreUpdateRequest $request, $website_id)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();
        if (!$website) return redirect()->back()->with('error', 'operação não autorizada');

        $data = $request->except(['_token']);
        $data['user_id'] = auth()->user()->id;
        $data['route'] =  Str::slug($request->name);
        $data['website_id'] = $website->id;

        $hashomepage = Page::where(['website_id' => $website->id, 'homepage' => 1])->first();
        if ($hashomepage and $request->homepage == 1) {
            $result = $hashomepage->update(['homepage' => 0]);
            if (!$result) return redirect()->back()->with('error', 'erro ao atualiza a homepage');
        }

        $result = Page::create($data);

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('pages', $website->id)->with('success', 'Pagina criado com sucesso');
    }

    public function update(PageStoreUpdateRequest $request, $website_id, $pageid)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();
        $page = Page::find($pageid);

        if (!$website || !$page) return redirect()->back()->with('error', 'operação não autorizada');

        $data = $request->except(['_token']);
        $data['route'] =  Str::slug($request->name);

        $hashomepage = Page::where(['website_id' => $website->id, 'homepage' => 1])->first();
        if ($hashomepage and $request->homepage == 1) {
            $result = $hashomepage->update(['homepage' => 0]);
            if (!$result) return redirect()->back()->with('error', 'erro ao atualiza a homepage');
        }

        $result = $page->update($data);

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('pages', $website->id)->with('success', 'Pagina editada com sucesso');
    }

    public function delete($website_id, $pageid)
    {
        $website = WebSite::where(['id' => $website_id, 'user_id' => auth()->user()->id])->first();
        $page = Page::find($pageid);

        if (!$website || !$page) return redirect()->back()->with('error', 'operação não autorizada');

        $result = $page->delete();

        if (!$result) return redirect()->back()->with('error', 'erro na operação');

        return redirect()->route('pages', $website->id)->with('success', 'WebSite removido com sucesso');
    }
}
