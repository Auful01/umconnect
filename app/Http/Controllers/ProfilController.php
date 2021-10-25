<?php

namespace App\Http\Controllers;

use App\Models\Profil;
// use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::all();
        return view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $profil = Profil::create([
            'id_user' => $request->id_user,
            'nim' => $request->nim,
            'domisili' => $request->domisili,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'wa' => $request->wa
        ]);

        return redirect()->route('user.show', $profil->id_user);
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
        $profil = Profil::find($id);
        $profil->nim = $request->nim;
        $profil->domisili = $request->domisili;
        $profil->jenis_kelamin = $request->jenis_kelamin;
        $profil->tgl_lahir = $request->tgl_lahir;
        $profil->wa = $request->wa;
        $profil->save();

        return redirect()->route('user.show', $profil->id_user);
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


    public function uploadFoto(Request $request, $id)
    {
        // return [$request, $id];
        $profil = Profil::find($id);
        if ($profil->photo != null) {
            Storage::delete('storage/' . $profil->photo);
        }
        // return $request->file('photo');
        $img_name = $request->file('photo')->store('photo', 'public');
        $profil->photo = $img_name;
        $profil->save();

        return redirect()->route('user.show', $id);
    }
}
