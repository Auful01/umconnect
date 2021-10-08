<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KirimanRequest;
use App\Models\Kiriman;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $user = auth()->user();
        $kiriman = Kiriman::with('user')->where('id_user', $user->id)->get();

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
        $request->validated();

        $user = auth()->user();
        $kiriman = Kiriman::create([
            'id_user' => $user->id,
            'gambar' => $request->gambar,
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
    public function show(Kiriman $kiriman)
    {
        return $this->apiSuccess($kiriman->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KirimanRequest $request, Kiriman $kiriman)
    {
        $request->validated();
        $kiriman->gambar = $request['gambar'];
        $kiriman->konten = $request['konten'];
        $kiriman->save();
        return $this->apiSuccess($kiriman->load('user'));
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
