<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request){
        $liga = DB::table('liga')->get();
        $produk = DB::table('produk')->orderBy('id','desc')->limit(4)->get();
        $countKeranjang = 0;
        if($request->session()->get('id')){
            $countKeranjang = DB::table('keranjang')->where('id_user',$request->session()->get('id'))->count();
        }
        return view('web.index',[
            'liga' => $liga,
            'produk' => $produk,
            'countKeranjang' => $countKeranjang,
        ]);
    }

    public function jersey(Request $request,$id_liga = ''){
        $liga = 'All';
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
            $qliga = DB::table('liga')->where('id',$id_liga)->get()[0];
            $liga = $qliga->nama;
        }

        $countKeranjang = 0;
        if($request->session()->get('id')){
            $countKeranjang = DB::table('keranjang')->where('id_user',$request->session()->get('id'))->count();
        }
        return view('web.jersey',[
            'produk' => $produk,
            'id_liga' => $id_liga,
            'countKeranjang' => $countKeranjang,
            'liga' => $liga,
        ]);
    }

    public function detail(Request $request, $id){
        $produk = DB::table('produk')->join('liga','liga.id','=','produk.id_liga')->select('produk.*','liga.gambar as gambar_liga')->where('produk.id',$id)->get()[0];

        $countKeranjang = 0;
        if($request->session()->get('id')){
            $countKeranjang = DB::table('keranjang')->where('id_user',$request->session()->get('id'))->count();
        }

        return view('web.detail',[
            'produk' => $produk,
            'countKeranjang' => $countKeranjang,
        ]);
    }

    public function keranjang(Request $request){

        $data = DB::table('produk')->select('produk.*','keranjang.qty','keranjang.id as id_keranjang')->join('keranjang','keranjang.id_produk','produk.id')->where('keranjang.id_user',$request->session()->get('id'))->get();

        $countKeranjang = 0;
        if($request->session()->get('id')){
            $countKeranjang = DB::table('keranjang')->where('id_user',$request->session()->get('id'))->count();
        }

        $bank = DB::table('bank')->get();

        return view('web.keranjang',[
            'data' => $data,
            'countKeranjang' => $countKeranjang,
            'bank' => $bank,
        ]);
    }

    public function store_keranjang(Request $request)
    {
        $validate = $request->validate([
            'qty' => 'required'
        ]);

        if($request->session()->get('name')){
            $data = [
                'id_produk' => $request->id_produk,
                'id_user' => $request->session()->get('id'),
            ];

            $produk = DB::table('produk')->where('id',$request->id_produk)->get()[0];
            $stok = intval($produk->stok);

            if($stok < intval($request->qty)){
                return redirect('jersey/detail/'.$request->id_produk)->with('error','Stok tidak mencukupi');
            }

            $checkProdukExist = DB::table('keranjang')->where('id_produk',$request->id_produk)->get();

            if(isset($checkProdukExist[0]->qty)){
                $stok_keranjang = intval($checkProdukExist[0]->qty) + intval($request->qty);
                if($stok < $stok_keranjang){
                    return redirect('jersey/detail/'.$request->id_produk)->with('error','Stok tidak mencukupi, silahkan cek keranjang anda');
                }

                $data['qty'] = intval($request->qty) + intval($checkProdukExist[0]->qty);
                $post = DB::table('keranjang')->where('id',$checkProdukExist[0]->id)->update($data);
            }else{
                $data['qty'] = $request->qty;
                $post = DB::table('keranjang')->insert($data);
            }

            if($post){
                return redirect('keranjang');
            }else{
                return redirect('/login');
            }
        }else{
            return redirect('/login');
        }
    }

    public function checkout(Request $request)
    {
        $validate = $request->validate([
            'nohp' => 'required',
            'alamat' => 'required',
            'idbank' => 'required',
        ]);

        $datapayment = [
            'noresi' => date('Ymdhis'),
            'iduser' => $request->session()->get('id'),
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'bukti_transfer' =>  $request->file('bukti_transfer')->store('bukti_transfer'),
            'status' => 0,
            'tglbayar' => date('Y-m-d h:i:s'),
        ];

        $payment = DB::table('payment')->insertGetId($datapayment);

        if($payment){
            $keranjang = DB::table('keranjang')->join('produk','produk.id','=','keranjang.id_produk')->where('id_user',$request->session()->get('id'))->get();
            foreach($keranjang as $k){
                $datadetailpayment = [
                    'id_payment' => $payment,
                    'id_produk' => $k->id_produk,
                    'qty' => $k->qty,
                    'totalharga' => intval($k->harga) * intval($k->qty),
                ];

                $detailpayment = DB::table('detail_payment')->insert($datadetailpayment);

                if($detailpayment){
                    $produk = DB::table('produk')->where('id',$k->id_produk)->get()[0];
                    $dataUpdateStok = [
                        'stok' => intval($produk->stok) - intval($k->qty)
                    ];
                    $updatestok = DB::table('produk')->where('id',$k->id_produk)->update($dataUpdateStok);

                    if($updatestok){
                        //reset keranjang
                        DB::table('keranjang')->where('id_user',$request->session()->get('id'))->delete();
                        //reset keranjang
                    }else{
                        return redirect('/keranjang')->with('error', 'Checkout gagal');
                    }
                }else{
                    return redirect('/keranjang')->with('error', 'Checkout gagal');
                }
            }

            return redirect('/keranjang')->with('success', 'Checkout berhasil');
        }else{
            return redirect('/keranjang')->with('error', 'Checkout gagal');
        }
    }

}
