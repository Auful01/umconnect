<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdukController extends Controller
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
        $produk = Produk::with('users')->where('id_user', $user->id);

        return $this->apiSuccess($produk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        $request->validated();

        $user = auth()->user();
        $produk = Produk::create([
            'id_user' => $user->id,
            'gambar' => $request->gambar,
            'harga' => $request->harga,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi
        ]);

        return $this->apiSuccess($produk);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return $this->apiSuccess($produk->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, Produk $produk)
    {
        $request->validated();
        $produk->gambar = $request['gambar'];
        $produk->harga = $request['harga'];
        $produk->nama_produk = $request['nama_produk'];
        $produk->deskripsi = $request['deskripsi'];
        $produk->save();

        return $this->apiSuccess($produk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if (auth()->user()->id == $produk->id_user) {
            $produk->delete();
            return $this->apiSuccess($produk);
        }

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
