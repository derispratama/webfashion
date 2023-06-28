<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $liga = DB::table('liga')->get();
        $produk = DB::table('produk')->orderBy('id','desc')->limit(4)->get();
        return view('web.index',[
            'liga' => $liga,
            'produk' => $produk,
        ]);
    }

    public function jersey(Request $request,$id_liga = ''){
        if($id_liga == ''){
            if(isset($request->search_jersey)){
                $produk = DB::table('produk')->where('nama','like',$request->search_jersey.'%')->orderBy('id','desc')->get();;
            }else{
                $produk = DB::table('produk')->orderBy('id','desc')->get();;
            }
        }else{
            if(isset($request->search_jersey)){
                $produk = DB::table('produk')->where('id_liga', $id_liga)->where('nama','like',$request->search_jersey.'%')->orderBy('id','desc')->get();;
            }else {
                $produk = DB::table('produk')->where('id_liga', $id_liga)->orderBy('id', 'desc')->get();
            }
        }

        return view('web.jersey',[
            'produk' => $produk,
            'id_liga' => $id_liga
        ]);
    }

    public function detail($id){
        $produk = DB::table('produk')->join('liga','liga.id','=','produk.id_liga')->select('produk.*','liga.gambar as gambar_liga')->where('produk.id',$id)->get()[0];
        return view('web.detail',[
            'produk' => $produk
        ]);
    }

    public function keranjang(){
        return view('web.keranjang');
    }
}
