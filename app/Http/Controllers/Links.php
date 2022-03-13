<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\ShortLinkCreator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;


class Links extends Controller
{

    public function __construct(
        private ShortLinkCreator $linkCreator
    )
    {
    }

    public function home(): View
    {
        return view('home', ['links' => Link::all()]);
    }

    public function redirect(string $shortLink)
    {

        $hash = substr($shortLink, 2);
        $url = false;
        foreach (Link::all() as $link) {
            $link['hash'] === $hash && $url = $link['origin_url'];
        }

        !$url && abort('404');

        return redirect()->away($url);

    }

    public function create(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        $url = $request->input('url');

        $link = new Link;
        $link->origin_url = $url;
        $link->hash = $this->linkCreator->getHash();

        $link->save();

        return redirect()->route('home');
    }

    public function delete($id)
    {

        $link = Link::find($id);
        $link?->delete();

        return redirect()->route('home');

    }

}
