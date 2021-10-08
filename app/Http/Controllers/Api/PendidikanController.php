<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendidikanRequest;
use App\Models\Pendidikan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PendidikanController extends Controller
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
        $pendidikan = Pendidikan::with('users')->where('id_user', $user->id);

        return $this->apiSuccess($pendidikan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendidikanRequest $request)
    {
        $request->validated();

        $user = auth()->user();
        $pendidikan = Pendidikan::create([
            'id_user' => $user->id,
            'instansi' => $request->instansi,
            'jenjang' => $request->jenjang,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return $this->apiSuccess($pendidikan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        return $this->apiSuccess($pendidikan->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PendidikanRequest $request, Pendidikan $pendidikan)
    {
        $request->validated();
        $pendidikan->instansi = $request['instansi'];
        $pendidikan->jenjang  = $request['jenjang'];
        $pendidikan->fakultas = $request['fakultas'];
        $pendidikan->jurusan = $request['jurusan'];
        $pendidikan->tahun_masuk = $request['tahun_masuk'];
        $pendidikan->tahun_keluar = $request['tahun_keluar'];
        $pendidikan->save();

        return $this->apiSuccess($pendidikan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendidikan $pendidikan)
    {
        if (auth()->user()->id == $pendidikan->id_user) {
            $pendidikan->delete();
            return $this->apiSuccess($pendidikan);
        }

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
