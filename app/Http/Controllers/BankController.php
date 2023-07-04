<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('bank')->get();
        return view('bank.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:20',
            'atasnama' => 'required|max:100',
            'norek' => 'required|max:20',
            'gambar' => 'required|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'nama' => $request->nama,
            'atasnama' => $request->atasnama,
            'norek' => $request->norek,
            'gambar' => $request->file('gambar')->store('bank'),
        ];

        $action = DB::table('bank')->insert($data);

        if ($action) {
            return redirect('/bank')->with('success', 'Bank berhasil ditambahkan');
        } else {
            return redirect('/bank/create')->with('error', 'Bank gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('bank')->where('id',$id)->get()[0];
        return view('bank.form',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:20',
            'atasnama' => 'required|max:100',
            'norek' => 'required|max:20',
        ]);

        $data = [
            'nama' => $request->nama,
            'atasnama' => $request->atasnama,
            'norek' => $request->norek,
        ];

        if(isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != ''){
            $data['gambar'] = $request->file('gambar')->store('bank');
        }

        $action = DB::table('bank')->where('id',$request->id)->update($data);

        if ($action) {
            return redirect('/bank')->with('success', 'Bank berhasil diubah');
        } else {
            return redirect('/bank/'.$request->id.'/edit')->with('error', 'Bank gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
