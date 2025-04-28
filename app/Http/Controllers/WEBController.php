<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class WEBController extends Controller
{
    function loginview()
    {
        $r = request('r');
        if (Auth::check()) {
            $role = auth()->user()->user_role;
            if ('admin' == $role) {
                $url = route('admin.home');
            } else if ('client' == $role) {
                $url = route('home');
            } else {
                abort(403, 'Who are you ?');
            }
            if ($r) {
                $url = urldecode($r);
            }
            return redirect($url);
        }
        return view('login');
    }

    function home()
    {
        $livre = Livre::first();
        return view('index', compact('livre'));
    }
    function blog()
    {
        $blog = Blog::where('id', request('v'))->first();
        if ($blog) {
            $text = $blog->text;
            if (strlen($text) > 10) {
                $CrawlerDetect = new CrawlerDetect();
                if (!$CrawlerDetect->isCrawler()) {
                    $blog->increment('view');
                }
            } else {
                $blog = null;
            }
        }
        $blogs = Blog::orderBy('date', 'desc');
        $blogs  = $blogs->paginate(9);
        return view('blog',  compact('blogs', 'blog'));
    }

    function blogdl()
    {
        $CrawlerDetect = new CrawlerDetect();
        abort_if($CrawlerDetect->isCrawler(), 401);

        abort_if(!auth()->check(), 401);

        $user = auth()->user();
        $blog = Blog::where(['id' => request('item')])->first();
        if ($blog) {
            abort_if(!candl($blog), 404);

            $blog->increment('dl');
            $file = 'storage/' . $blog->fichier;
            if (!file_exists($file)) {
                abort(404);
            }
            $name = $blog->titre . ".pdf";
            return Response::download($file, $name);
        }
        abort(403);
    }
}
