<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
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
        $profil = Profil::with('users')->where('id_user', $user->id);

        return $this->apiSuccess($profil);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfilRequest $request)
    {
        $request->validated();
        if ($request->file('photo')) {
            $img_name = $request->file('photo')->store('gambar', 'public');
        }
        $user = auth()->user();
        $profil = Profil::create([
            'id_user' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nim' => $request->nim,
            'tgl_lahir' => $request->tgl_lahir,
            'domisili' => $request->domisili,
            'wa' => $request->wa,
            'photo' => $img_name
        ]);

        return $this->apiSuccess($profil);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
    {
        return $this->apiSuccess($profil->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilRequest $request, Profil $profil)
    {
        $request->validated();
        // $profil->id_user =  $request['id_user'];
        $gbrlama = $profil->photo;
        // return $gbrlama;
        // return $request['photo'];
        if ($request['photo'] != null) {
            Storage::delete('storage/' . $profil->photo);
            $img_name = $request->file('photo')->store('photo', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $profil->jenis_kelamin = $request['jenis_kelamin'];
        $profil->nim = $request['nim'];
        $profil->tgl_lahir = $request['tgl_lahir'];
        $profil->domisili = $request['domisili'];
        $profil->wa = $request['wa'];
        $profil->photo = $img_name;
        $profil->save();

        return $this->apiSuccess($profil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        if (auth()->user()->id == $profil->id_user) {
            $profil->delete();
            return $this->apiSuccess($profil);
        }

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
