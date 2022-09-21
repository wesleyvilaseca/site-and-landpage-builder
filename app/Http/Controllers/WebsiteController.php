<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\WebSite;
use Illuminate\Http\Request;
use PHPageBuilder\Modules\GrapesJS\PageRenderer;
use PHPageBuilder\Repositories\PageRepository;
use PHPageBuilder\Theme;

class WebsiteController extends Controller
{
    /**
     * Show the website page that corresponds with the current URI.
     */
    public function uri(Request $request, $uri = '')
    {
        $url = request()->getHttpHost();

        $website = WebSite::where('site_url', 'http://' . $url)->orWhere('site_url', 'https://' . $url)->first();

        if (!$uri) {
            $page = Page::where(['website_id' => $website->id, 'homepage' => 1])->first();
        } else {
            $page = Page::where(['website_id' => $website->id, 'route' => $uri])->first();
        }

        $theme = new Theme(config('pagebuilder.theme'), config('pagebuilder.theme.active_theme'));
        $page = (new PageRepository)->findWithId($page->id);
        $pageRenderer = new PageRenderer($theme, $page);
        $html = $pageRenderer->render();
        return $html;
    }
}
