<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function smallSidebar()
    {
        if(Cookie::get('show_sidebar')){
            Cookie::queue(Cookie::make('show_sidebar', false, 10000000));
        } else {
            Cookie::queue(Cookie::make('show_sidebar', true, 10000000));
        }
        $cookies = Cookie::get('show_sidebar');

        return response()->json(['success' => $cookies]);
    }

    public function resume() {
        return view('resume');
    }
    public function resumeEn() {
        return view('resumeEn');
    }
}
