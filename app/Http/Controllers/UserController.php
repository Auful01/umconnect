<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\Models\Pendidikan;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('menu.admin.user', ['user' => $user]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $user = DB::table('users')
        //     ->join('profil', 'profil.id_user', '=', 'users.id')
        //     ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
        //     ->select('users.name', 'users.email')
        //     ->where('users.id', '=', $id)
        //     ->orderBy('users.id', 'asc')
        //     ->get(
        //         array(
        //             'name',
        //             'email',
        //             'status',
        //             'profil.nim',
        //             'profil.tgl_lahir',
        //             'profil.domisili',
        //             'profil.wa',
        //             'profil.photo',
        //             'profil.jenis_kelamin',
        //             'pendidikan.instansi',
        //             'pendidikan.jenjang',
        //             'pendidikan.fakultas',
        //             'pendidikan.jurusan',
        //             'pendidikan.tahun_masuk',
        //             'pendidikan.tahun_keluar'
        //         )
        //     )->first();

        // var_dump($user->name);
        // return $user;
        $user = User::find($id);
        $pendidikan = Pendidikan::with('user')->where('id_user',  $id)->first();
        $profil = Profil::with('user')->where('id_user', $id)->first();
        return view('menu.admin.user.detail', ['user' => $user, 'profil' => $profil,  'pendidikan' => $pendidikan]);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index');
    }

    public function changeStatus(Request $request)
    {
        // return $request;
        $user = User::find($request->id);
        if ($user->status == 1) {
            $user->status = 0;
            $details = [
                'title' => 'Mail from websitepercobaan.com',
                'body' => 'Email ' . $user->email . ' Anda Telah Dinonaktifkan'
            ];

            Mail::to($user->email)->send(new MyMail($details));
        } else {
            $user->status = 1;
            $user->email_verified_at = date("d-m-Y H:i:s");
            $details = [
                'title' => 'Mail from websitepercobaan.com',
                'body' => 'Email ' . $user->email . 'Anda Telah Aktif'
            ];

            Mail::to($user->email)->send(new MyMail($details));
        }
        $user->save();


        // dd("Email sudah terkirim.");

        $msg = ['Sukses', 'Data Berhasil ditambah'];
        return with($msg);
    }
}
