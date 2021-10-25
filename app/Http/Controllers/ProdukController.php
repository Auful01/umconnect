<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return view('menu.admin.produk', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }

        Produk::create([
            'id_user' => auth()->user()->id,
            'gambar' => $img_name,
            'harga' => $request->harga,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('produkWeb.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $img_name = $produk->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $produk->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }
        $produk->gambar = $img_name;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();

        return redirect()->route('produkWeb.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::find($id)->delete();
        return redirect()->route('produkWeb.index');
    }
}
