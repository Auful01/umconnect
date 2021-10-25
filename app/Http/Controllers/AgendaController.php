<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenda = Agenda::all();
        return view('menu.admin.agenda', ['agenda' => $agenda]);
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
        if ($request->file('photo')) {
            $img_name = $request->file('photo')->store('photo', 'public');
        }
        $agenda = Agenda::create([
            'id_user' => $request->id_user,
            'title' => $request->title,
            'photo' => $img_name,
            'konten' => $request->konten,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu
        ]);

        return redirect()->route('agendaWeb.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::find($id);
        return view('');
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
        $agenda = Agenda::find($id)->first();
        $img_name = $agenda->photo;
        if ($request->file('photo') != null) {
            Storage::delete('storage/' . $agenda->photo);
            $img_name = $request->file('photo')->store('photo', 'public');
        }
        $agenda->photo = $img_name;
        $agenda->lokasi = $request->lokasi;
        $agenda->tanggal = $request->tanggal;
        $agenda->konten = $request->konten;
        $agenda->title = $request->title;
        $agenda->waktu = $request->waktu;
        $agenda->save();

        return redirect()->route('agendaWeb.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agenda::find($id)->delete();
        return redirect()->route('agendaWeb.index');
    }

    public function switchAgendaStatus(Request $request)
    {
        // return $request;
        $agenda = Agenda::find($request->id);
        $agenda->status = $request->status;
        $agenda->save();


        // dd("Email sudah terkirim.");

        $msg = ['Sukses', 'Data Berhasil ditambah'];
        return with($msg);
    }
}
