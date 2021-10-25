@extends('layouts.main')

@section('content')

<a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahLayanan">Tambah Layanan</a>
<br>
<table id="myTable" class="table display">
    <thead>
        <th>#</th>
        <th>User</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Konten</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        @foreach ($layanan as $k)

        <tr>
            <td>{{ $no +=1 }}</td>
            <td>{{$k->user->name}}</td>
            <td><img src="{{'storage/'.$k->gambar}}" style="width: 150px" alt=""></td>
            <td>{{$k->judul}}</td>
            <td>{{$k->konten}}</td>

            <td>
                <div class="d-flex">
                    <a href="" class="btn btn-warning mr-1 btn-editLayanan" data-url="{{route('layananWeb.update', $k->id)}}" data-gambar="{{'storage/'.$k->gambar}}" data-judul="{{$k->judul}}" data-konten="{{$k->konten}}" data-target="#editLayanan"  data-toggle="modal"><i class="far fa-edit"></i></a>
                    <form action="{{route('layananWeb.destroy',$k->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('modal')
{{-- Create Layanan --}}
<div class="modal fade" id="tambahLayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('layananWeb.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Judul</label>
                  <input type="text" name="judul" class="form-control" id="judul" aria-describedby="emailHelp" placeholder="Masukkan Judul Layanan">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <input type="text" name="konten" class="form-control" id="konten" aria-describedby="emailHelp" placeholder="Konten">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>

                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
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

{{-- Edit --}}
<div class="modal fade" id="editLayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="url" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="exampleInputEmail1">Gambar</label>
                  <input type="file" name="gambar" class="form-control gambar" id="gambar" aria-describedby="emailHelp">
                  <img src="" class="gambar" style="width: 100px"  alt="" >
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Judul</label>
                  <input type="text" name="judul" class="form-control judul" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <input type="text" name="konten" class="form-control konten" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
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

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('.btn-editLayanan').on('click', function () {
        let gambar = $(this).data('gambar')
        let judul = $(this).data('judul')
        let konten = $(this).data('konten')
        let url = $(this).data('url')
        $('.gambar').attr('src',gambar)
        $('.judul').val(judul)
        $('.konten').val(konten)
        $('.url').attr('action', url)
    })
</script>
@endsection
