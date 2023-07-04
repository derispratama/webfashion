<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tot_lunas = DB::table('payment')->where('status',1)->count();
        $tot_blm_lunas = DB::table('payment')->where('status',0)->count();
        $tot_user = DB::table('users')->where('email','!=','admin@gmail.com')->count();
        $tot_pendapatan = DB::table('detail_payment')->join('payment','payment.id','=','detail_payment.id_payment')->select(DB::raw('SUM(totalharga) as total_harga'))->where('status',1)->get()[0]->total_harga;

        return view('dashboard.index',[
            'tot_lunas' => $tot_lunas,
            'tot_blm_lunas' => $tot_blm_lunas,
            'tot_user' => $tot_user,
            'tot_pendapatan' => $tot_pendapatan,
        ]);
    }

    public function chart(){
        $payment = DB::select('SELECT l.id as id_liga, l.nama as nama_liga, SUM(p.stok) as totalstok FROM produk p INNER JOIN liga l ON l.id = p.id_liga GROUP BY l.id,l.nama;');
        echo json_encode(['data' => $payment]);
    }
}
