<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenda = Agenda::all();
        return $this->apiSuccess($agenda);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendaRequest $request)
    {
        $request->validated();

        if ($request->file('photo')) {
            $img_name = $request->file('photo')->store('gambar', 'public');
        }
        $user = auth()->user();
        $agenda = Agenda::create([
            'id_user' => $user->id,
            'title' => $request->title,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'konten' => $request->konten,
            'photo' => $img_name,
            'status' => $request->status
        ]);

        return $this->apiSuccess($agenda->load('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $req = Agenda::find($id);
        return $this->apiSuccess($req);
    }

    public function detail($id)
    {
        $req = Agenda::find($id);
        return $this->apiSuccess($req, 200, 'Data Ditemukan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaRequest $request, Agenda $agenda)
    {
        $request->validated();

        $gbrlama = $agenda->photo;
        if ($request->file('photo') != null) {
            Storage::delete('public/' . $agenda->photo);
            $img_name = $request->file('photo')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $agenda->title = $request['title'];
        $agenda->lokasi = $request['lokasi'];
        $agenda->tanggal = $request['tanggal'];
        $agenda->waktu = $request['waktu'];
        $agenda->konten = $request['tanggal'];
        $agenda->photo = $img_name;
        $agenda->status = $request['status'];
        $agenda->save();

        return $this->apiSuccess($agenda->load('user'));
    }

    public function pembaruan(Request $request, $id)
    {
        // $request->validated()
        $agenda = Agenda::find($id);
        // return $agenda;
        $gbrlama = $agenda->photo;
        if ($request->file('photo') != null) {
            Storage::delete('public/' . $agenda->photo);
            $img_name = $request->file('photo')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $agenda->title = $request['title'];
        $agenda->lokasi = $request['lokasi'];
        $agenda->tanggal = $request['tanggal'];
        $agenda->waktu = $request['waktu'];
        $agenda->konten = $request['tanggal'];
        $agenda->photo = $img_name;
        $agenda->status = $request['status'];
        $agenda->save();

        return $this->apiSuccess($agenda->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        if (auth()->user()->id == $agenda->id_user) {
            $agenda->delete();
            return $this->apiSuccess($agenda);
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }

    public function hapus($id)
    {
        $agenda = Agenda::find($id);
        if (auth()->user()->id == $agenda->id_user) {
            $agenda->delete();
            return $this->apiSuccess($agenda);
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
