<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Layanan::all();
        return view('menu.admin.layanan', ['layanan' => $layanan]);
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

        $user = auth()->user();
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }

        Layanan::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'judul' => $request->judul,
            'konten' => $request->konten
        ]);

        return redirect()->route('layananWeb.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $layanan = Layanan::find($id);
        $img_name = $layanan->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $layanan->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }

        $layanan->gambar = $img_name;
        $layanan->judul = $request->judul;
        $layanan->konten = $request->konten;
        $layanan->save();

        return redirect()->route('layananWeb.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Layanan::find($id)->delete();
        return redirect()->route('layananWeb.index');
    }
}
