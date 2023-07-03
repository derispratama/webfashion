<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('payment')->select('payment.*','users.name','users.email')->join('users','users.id','=','payment.iduser')->get();
        return view('payment.index',[
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('detail_payment')->join('produk','produk.id','=','detail_payment.id_produk')->where('detail_payment.id_payment',$id)->get();
        $html = '';
        $no = 1;
        $total = 0;
        foreach($data as $row){
            $total+= intval($row->totalharga);

            $html .='<tr>';
            $html .='<th>'.$no++.'</th>';
            $html .='<th><img style="width: 100%;object-fit:contain; height: 100px;" alt="gambar" class="img-thumbnail" src="'.asset('storage/'.$row->gambar).'"></th>';
            $html .='<th>'.$row->nama.'</th>';
            $html .='<th>Rp.'.$row->harga.'</th>';
            $html .='<th>'.$row->qty.'</th>';
            $html .='<th>Rp.'.$row->totalharga.'</th>';
            $html .='</tr>';
        }

        $html.= '<tr>';
        $html.= '<th colspan="5" style="text-align: right;">Total Bayar</th>';
        $html.= '<th>Rp.'.$total.'</th>';
        $html.= '</tr>';

        echo json_encode(['html' => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('payment')->select('payment.*','users.name','users.email')->join('users','users.id','=','payment.iduser')->where('payment.id',$id)->get()[0];
        return view('payment.form',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nohp' => 'required|numeric',
            'alamat' => 'required',
        ]);

        $data = [
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
        ];

        if(isset($_FILES['bukti_transfer']['name']) && $_FILES['bukti_transfer']['name'] != ''){
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer');
        }

        $action = DB::table('payment')->where('id',$id)->update($data);

        if ($action) {
            return redirect('/payment')->with('success', 'Pembayaran berhasil diubah');
        } else {
            return redirect('/payment/'.$id.'/edit')->with('error', 'Pembayaran gagal diubah');
        }
    }

    public function verifikasi(Request $request)
    {
        $data['status'] = $request->status == 0 ? 1 : 0;
        $action = DB::table('payment')->where('id',$request->id)->update($data);
        if ($action) {
            echo json_encode(['msg' => 'Pembayaran berhasil di verifikasi','status' => true]);
        } else {
            echo json_encode(['msg' => 'Pembayaran gagal di verifikasi','status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $action = DB::table('payment')->where('id',$id)->delete();
        if ($action) {
            echo json_encode(['msg' => 'Pembayaran berhasil di hapus','status' => true]);
        } else {
            echo json_encode(['msg' => 'Pembayaran gagal di hapus','status' => false]);
        }
    }
}
