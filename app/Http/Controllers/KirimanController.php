<?php

namespace App\Http\Controllers;

use App\Models\Kiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kiriman = Kiriman::all();
        return view('menu.admin.kiriman', ['kiriman' => $kiriman]);
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
        // return $request->file('gambar');

        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }

        $user = auth()->user();
        Kiriman::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'konten' => $request->konten
        ]);

        return redirect()->route('kiriman.index');
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
        $kiriman = Kiriman::find($id);
        $img_name = $kiriman->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $kiriman->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }
        $kiriman->gambar = $img_name;
        $kiriman->konten = $request->konten;
        $kiriman->save();

        return redirect()->route('kiriman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kiriman = Kiriman::find($id);
        Storage::delete('storage/' . $kiriman->gambar);
        $kiriman->delete();
        return redirect()->route('kiriman.index');
    }
}
