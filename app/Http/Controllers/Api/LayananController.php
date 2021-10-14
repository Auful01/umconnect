<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananRequest;
// use App\Models\Layanan;
use App\Models\Layanan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();
        $layanan = Layanan::all();

        return $this->apiSuccess($layanan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LayananRequest $request)
    {
        $request->validated();

        $user = auth()->user();
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }
        $layanan = Layanan::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'judul' => $request->judul,
            'konten' => $request->konten
        ]);

        return $this->apiSuccess($layanan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        return $this->apiSuccess($layanan->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {


        // return $request['judul'];
        // $request->validated();

        $user = auth()->user();
        $gbrlama = $layanan->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('public/' . $layanan->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }

        $layanan->gambar = $img_name;
        $layanan->judul = $request['judul'];
        $layanan->konten = $request['konten'];
        $layanan->save();
        return $this->apiSuccess($layanan->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        if (auth()->user()->id == $layanan->id_user) {
            $layanan->delete();
            return $this->apiSuccess($layanan);
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
