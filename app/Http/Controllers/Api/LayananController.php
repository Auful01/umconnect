<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananRequest;
use App\Models\Kiriman;
use App\Models\Layanan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $user = auth()->user();
        $layanan = Layanan::with('user')->where('id_user', $user->id);

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
        $kiriman = Kiriman::create([
            'id_user' => $user->id,
            'gambar' => $request->gambar,
            'judul' => $request->judul,
            'konten' => $request->konten
        ]);

        return $this->apiSuccess($kiriman);
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
    public function update(LayananRequest $request, Layanan $layanan)
    {
        $request->validated();

        $user = auth()->user();
        $layanan->gambar = $request['gambar'];
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
    public function destroy(Kiriman $kiriman)
    {
        if (auth()->user()->id == $kiriman->id_user) {
            $kiriman->delete();
            return $this->apiSuccess($kiriman);
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
