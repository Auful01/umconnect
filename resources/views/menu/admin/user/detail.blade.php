@extends('layouts.main')

@section('content')
<div style="background-repeat: no-repeat;background-size: 300px; background-position: right center; background-image: url({{asset('images/Lambang-UM.png')}});">

    {{-- <div class="row d-flex justify-content-around">
        <div class="col-md-4 d-flex justify-content-center">
            <img src="{{asset('images/ipul.jpeg')}}"  style="clip-path: circle()" class=" w-50" alt="">
        </div>
        <div class="col-md-6">
            <h4>{{$user->name}}</h4>
        </div>

    </div> --}}
</div>
<div class="container">
    <div class="row d-flex justify-content-around">
        <div class="col-md-12 mb-5">
            <img src="{{asset('images/Lambang-UM.png')}}" style="width: 250px;opacity: 0.5; float: right;" alt="">
            <div class="left-side mr-5" style="width: 150px; float: left;">
                <img src="{{$profil==null ? asset('images/ipul.jpeg') : asset('storage/'.$profil->photo)}}" style="clip-path: circle();" class="w-100" alt="">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary edit-foto" @if ($profil != null)
                    data-target="#upfoto"  data-toggle="modal"  data-foto="{{$profil->photo}}" data-url="{{route('upfoto',$profil->id_user)}}"
                    @else
                    onclick="return alert('Harap Lengkapi Profil terlebih dahulu untuk mengupload foto')"
                    @endif   style="margin-top: 15px;width: max-content">Edit Foto</button>
                    <input type="file" name="photo" class="btn btn-primary upload-foto" id="" hidden>
                </div>
            </div>
            <div class="right-side detail mt-5">
                <h4 >{{$user->name}}</h4>
                <p class="mb-0">{{$user->email}}</p>
                {{-- <a  class="btn btn-success">Coba</a> --}}
                <p class="mb-0">@if ($user->level == 1)
                    Admin
                    @else
                    User
                @endif</p>
                <p class="mb-0">
                    @if ($user->status != 0)
                    <a href=""  class="btn btn-success" >Akun Diverifikasi</a>
                    @else
                    <a href="" class="btn btn-danger">Akun Belum Diverifikasi</a>
                    @endif
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <p class="bg-light p-2 rounded pl-5 py-3" ><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;&nbsp;Pendidikan</p>
            </div>
            <div class="row container">
                @if ($pendidikan == null)
                <div class="col-md-12 d-flex justify-content-center">
                    <p class="alert alert-danger" style="width: max-content">Tidak Ditemukan Data</p>
                </div>
                <button href="" class="btn btn-info mt-3" style="width: max-content" data-toggle="modal" data-target="#createPendidikan">Buat Pendidikan</button>

                @else
                <div class="col-md-12">
                    <table>
                        <tr>
                            <td>Instansi</td>
                            <td>&nbsp;&nbsp;: @if ($pendidikan->instansi != null)
                                        {{$pendidikan->instansi}}
                                        @else
                                        Belum diisi
                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Jenjang</td>
                            <td>&nbsp;&nbsp;: @if ($pendidikan->jenjang != null)
                                {{$pendidikan->jenjang}}
                                @else
                                Belum diisi
                            @endif</td>
                        </tr>
                        <tr>
                            <td>Fakultas</td>
                            <td>&nbsp;&nbsp;: @if ($pendidikan->fakultas != null)
                                {{$pendidikan->fakultas}}
                                @else
                                Belum diisi
                            @endif</td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td>&nbsp;&nbsp;: @if ($pendidikan->jurusan != null)
                                {{$pendidikan->jurusan}}
                                @else
                                Belum diisi
                            @endif</td>
                        </tr>
                        <tr>
                            <td>Tahun Masuk</td>
                            <td>&nbsp;&nbsp;:@if ($pendidikan->tahun_masuk != null)
                                {{$pendidikan->tahun_masuk}}
                                @else
                                Belum diisi
                            @endif</td>
                        </tr>
                        <tr>
                            <td>Tahun Keluar</td>
                            <td>&nbsp;&nbsp;: @if ($pendidikan->tahun_keluar != null)
                                {{$pendidikan->tahun_keluar}}
                                @else
                                Belum diisi
                            @endif</td>
                        </tr>
                    </table>
                </div>

                <button href="" class="btn btn-info mt-3 btn-editPendidikan" style="width: max-content" data-toggle="modal" data-target="#editPendidikan" data-instansi="{{$pendidikan->instansi}}" data-jenjang="{{$pendidikan->jenjang}}" data-fakultas="{{$pendidikan->fakultas}}" data-jurusan="{{$pendidikan->jurusan}}" data-masuk="{{$pendidikan->tahun_masuk}}" data-keluar="{{$pendidikan->tahun_keluar}}" data-url="{{route('pendidikan-user.update',$pendidikan->id_user)}}">Edit Pendidikan</button>

                @endif


            </div>

        </div>

        <div class="col-md-6">
            <div class="box">
            <p  class="bg-light p-2 rounded pl-5 py-3"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Profil</p>
            <div class="row container">
            @if ($profil == null)
            <div class="col-md-12 d-flex justify-content-center">
                <p class="alert alert-danger" style="width: max-content">Tidak Ditemukan Data</p>
            </div>
            <button href="" class="btn btn-info mt-3" style="width: max-content" data-toggle="modal" data-target="#createProfil">Buat Profil</button>


            @else
            <div class="col-md-12">
                <table>
                    <tr>
                        <td>NIM</td>
                        <td>&nbsp;&nbsp;: @if ($profil->nim != null)
                            {{$profil->nim}}
                            @else
                            Belum diisi
                        @endif</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>&nbsp;&nbsp;: @if ($profil->tgl_lahir != null)
                            {{$profil->tgl_lahir}}
                            @else
                            Belum diisi
                        @endif</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>&nbsp;&nbsp;: @if ($profil->jenis_kelamin != null)
                            {{$profil->jenis_kelamin}}
                            @else
                            Belum diisi
                        @endif</td>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <td>&nbsp;&nbsp;: @if ($profil->domisili != null)
                            {{$profil->domisili}}
                            @else
                            Belum diisi
                        @endif</td>
                    </tr>
                    <tr>
                        <td>WA</td>
                        <td>&nbsp;&nbsp;:@if ($profil->wa != null)
                            {{$profil->wa}}
                            @else
                            Belum diisi
                        @endif</td>
                    </tr>
                </table>
            </div>

            <button href="" class="btn btn-info mt-3 btn-editProfil" style="width: max-content" data-toggle="modal" data-target="#editProfil" data-nim="{{$profil->nim}}" data-lahir="{{$profil->tgl_lahir}}" data-jk="{{$profil->jenis_kelamin}}" data-domisili="{{$profil->domisili}}" data-wa="{{$profil->wa}}" data-url="{{route('profil-user.update', $profil->id_user)}}">Edit Profil</button>

            @endif


            </div>

            </div>
        </div>


    </div>
</div>



@endsection


@section('modal')
    {{-- Modal Edit Profil --}}

<div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="editModal url" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleInputEmail1">NIM</label>
                  <input type="text" name="nim" class="form-control nim" id="nim" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Domisili</label>
                  <input type="text" name="domisili" class="form-control domisili" id="domisili" placeholder="Domisili">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control jk">
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl-lahir" class="form-control lahir">
                </div>
                <div class="form-group">
                    <label for="">WA</label>
                    <input type="text" name="wa" id="wa" class="form-control wa">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

  {{-- Create Profil --}}
<div class="modal fade" id="createProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('profil-user.store')}}" method="POST">
                @csrf
                <input type="text" name="id_user" value="{{Request::segment(2)}}" hidden >
                <div class="form-group">
                  <label for="exampleInputEmail1">NIM</label>
                  <input type="text" name="nim" class="form-control" id="nim" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Domisili</label>
                  <input type="text" name="domisili" class="form-control" id="domisili" placeholder="Domisili">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl-lahir" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">WA</label>
                    <input type="text" name="wa" id="wa" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>

  {{-- Modal Edit Pendidikan --}}

  <div class="modal fade" id="editPendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Pendidikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="editModal url" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleInputEmail1">Instansi</label>
                  <input type="text" name="instansi" class="form-control instansi" id="instansi" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Jenjang</label>
                  <input type="text" name="jenjang" class="form-control jenjang" id="jenjang" placeholder="Domisili">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fakultas</label>
                  <input type="text" name="fakultas" class="form-control fakultas" id="fakultas" placeholder="Domisili">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Jurusan</label>
                  <input type="text" name="jurusan" class="form-control jurusan" id="jurusan" placeholder="Domisili">
                </div>
                <div class="form-group">
                    <label for="">Tahun Masuk</label>
                    <input type="month" name="tahun_masuk" id="tahun_masuk" class="form-control masuk">
                </div>
                <div class="form-group">
                    <label for="">Tahun Keluar</label>
                    <input type="month" name="tahun_keluar" id="tahun_keluar" class="form-control keluar">
                </div>
                {{-- <div class="form-group">
                    <label for="">WA</label>
                    <input type="text" name="wa" id="wa" class="form-control">
                </div> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  {{-- Create Pendidikan --}}
  <div class="modal fade" id="createPendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Pendidikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action=" {{route('pendidikan-user.store')}}" method="POST">
                @csrf
                <input type="text" name="id_user" value="{{Request::segment(2)}}" >
                <div class="form-group">
                  <label for="exampleInputEmail1">Instansi</label>
                  <input type="text" name="instansi" class="form-control" id="instansi" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Jenjang</label>
                  <input type="text" name="jenjang" class="form-control" id="jenjang" placeholder="Domisili">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fakultas</label>
                  <input type="text" name="fakultas" class="form-control" id="fakultas" placeholder="Domisili">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Jurusan</label>
                  <input type="text" name="jurusan" class="form-control" id="jurusan" placeholder="Domisili">
                </div>
                <div class="form-group">
                    <label for="">Tahun Masuk</label>
                    <input type="month" name="tahun_masuk" id="tahun_masuk" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tahun Keluar</label>
                    <input type="month" name="tahun_keluar" id="tahun_keluar" class="form-control">
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- UPLOAD PHOTO --}}
  <div class="modal fade" id="upfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" class="url" method="post" enctype="multipart/form-data">
              @csrf
              {{-- @method('PUT') --}}
              <div class="form-group">
                  <label for="">Upload Foto</label>
                  <input type="file" class="form-control photo" name="photo">
              </div>
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
      $('.btn-editPendidikan').on('click', function () {
          let instansi = $(this).data('instansi')
          let jenjang = $(this).data('jenjang')
          let fakultas = $(this).data('fakultas')
          let jurusan = $(this).data('jurusan')
          let masuk = $(this).data('masuk')
          let keluar = $(this).data('keluar')
          let url = $(this).data('url')
          $('.instansi').val(instansi)
          $('.jenjang').val(jenjang)
          $('.fakultas').val(fakultas)
          $('.jurusan').val(jurusan)
          $('.masuk').val(masuk)
          $('.keluar').val(keluar)
          $('.url').attr('action',url)
      })

      $('.btn-editProfil').on('click', function () {
          let nim = $(this).data('nim')
          let lahir = $(this).data('lahir')
          let jk = $(this).data('jk')
          let domisili = $(this).data('domisili')
          let wa = $(this).data('wa')
          let url = $(this).data('url')
          $('.nim').val(nim)
          $('.lahir').val(lahir)
          $('.jk').val(jk)
          $('.domisili').val(domisili)
          $('.wa').val(wa)
          $('.url').attr('action', url)
      })

      $('.edit-foto').on('click', function(){
        let url = $(this).data('url')
        let photo = $(this).data('photo')
        $('.url').attr('action', url)
        $('.photo').attr('src', photo)
      })
  </script>
@endsection


