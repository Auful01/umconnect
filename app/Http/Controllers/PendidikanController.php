<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendidikan = Pendidikan::all();
        return view('menu.admin.pendidikan', ['pendidikan' => $pendidikan]);
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
        $pendidikan = Pendidikan::create([
            'id_user' => $request->id_user,
            'instansi' => $request->instansi,
            'jenjang' => $request->jenjang,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
            // 'wa' => $request->wa,
        ]);

        return redirect()->route('user.show', $pendidikan->id_user);
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
        $pendidikan = Pendidikan::find($id);
        $pendidikan->instansi = $request->instansi;
        $pendidikan->fakultas = $request->fakultas;
        $pendidikan->jenjang = $request->jenjang;
        $pendidikan->jurusan = $request->jurusan;
        $pendidikan->tahun_masuk = $request->tahun_masuk;
        $pendidikan->tahun_keluar = $request->tahun_keluar;
        $pendidikan->save();

        return redirect()->route('user.show', $pendidikan->id_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
