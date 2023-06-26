<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('web.index');
    }

    public function jersey(){
        return view('web.jersey');
    }

    public function detail($id){
        return view('web.detail');
    }

    public function keranjang(){
        return view('web.keranjang');
    }
}
