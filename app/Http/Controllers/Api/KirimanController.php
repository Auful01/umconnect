<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KirimanRequest;
use App\Models\Kiriman;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KirimanController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Auth::user();
        $kiriman = Kiriman::all();

        return $this->apiSuccess($kiriman);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KirimanRequest $request)
    {

        // return $request->file('gambar');
        $request->validated();

        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            return $this->apiError('Eror', 404, 'Gambar harus diisi');
        }
        $user = auth()->user();
        $kiriman = Kiriman::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'konten' => $request->konten
        ]);
        // $kiriman->user()->associate($user);
        // $kiriman->save();

        return $this->apiSuccess($kiriman);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kiriman = Kiriman::find($id);
        return $this->apiSuccess($kiriman);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // return $kiriman->gambar;
        // if ($kiriman->id) {
        // $request->validated();

        $kiriman = Kiriman::find($id);
        $gbrlama = $kiriman->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $kiriman->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $kiriman->id_user = auth()->user()->id;
        $kiriman->gambar = $img_name;
        $kiriman->konten = $request['konten'];
        $kiriman->save();
        // }

        return $this->apiSuccess($kiriman->load('user'));
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
