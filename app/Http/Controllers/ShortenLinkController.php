<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortenLinkController extends Controller
{
    public function index(){

        return view('shorten-link');
    }

    public function storeUrl(UrlRequest $request)
    {

        $shortenLink=ShortLink::where('url','=',$request->url)->first();
        if($shortenLink == null)
        {
            $code=Str::random(5);
            ShortLink::create([
                'url'=>$request->url,
                'code'=>$code
            ]);
            $shorten_url=env('app_url').$code;
        }
        else
        {
            $shorten_url=env('app_url').$shortenLink->code;
        }



        return response()->json([
            'shorten_url'=>$shorten_url
        ]);

    }
    public function redirectToUrl($code){

        $shortLink=ShortLink::where('code','=',$code)->first();

        return redirect($shortLink->url);

    }
}
