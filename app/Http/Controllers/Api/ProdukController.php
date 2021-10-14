<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $produk = Produk::all();

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
        // return Auth::user()->id;
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }
        $produk = Produk::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
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
        $gbrlama = $produk->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $produk->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $produk->gambar = $img_name;
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
