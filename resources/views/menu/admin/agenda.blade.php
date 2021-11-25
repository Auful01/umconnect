@extends('layouts.main')

@section('content')

<a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahAgenda">Tambah agenda</a>
<br>
<table id="myTable" class="table display">
    <thead>
        <th>#</th>
        <th>User</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Konten</th>
        <th>Lokasi</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>status</th>
        <th>action</th>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        @foreach ($agenda as $a)
        {{-- {{$agenda->konten}} --}}

        <tr>
            <td>{{ $no +=1 }}</td>
            <td>{{$a->user->name}}</td>
            <td><img src="{{'storage/'.$a->photo}}" style="width: 150px" alt=""></td>
            <td>{{$a->title}}</td>
            <td>{{$a->konten}}</td>
            <td>{{$a->lokasi}}</td>
            <td>{{$a->tanggal}}</td>
            <td>{{$a->waktu}}</td>
            <td>
                <label class="switch">
                    <input type="checkbox" class="status-agenda-switch" data-id="{{$a->id}}" {{$a->status == 1 ? 'checked' : ''}}>
                    <span class="slider round"></span>
                  </label>
            </td>
            <td>
                <div class="d-flex">
                    <a href="" class="btn btn-warning mr-1 btn-editAgenda" data-toggle="modal" data-target="#editAgenda" data-id="{{$a->id}}" data-title="{{$a->title}}" data-konten="{{$a->konten}}" data-lokasi="{{$a->lokasi}}" data-tanggal="{{$a->tanggal}}" data-waktu="{{$a->waktu}}" data-url="{{route('agendaWeb.update',$a->id)}}" data-photo="{{asset('storage/'.$a->photo)}}"><i class="far fa-edit"></i></a>
                    <form action="{{route('agendaWeb.destroy', $a->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('.status-agenda-switch').on('change', function () {
        let id = $(this).data('id')
        let status = $(this).prop('checked' ) == true ? 1 : 0
        console.log('coba',id);
        $.ajax({
            url  : "/changeAgendaStatus",
            type : "GET",
            dataType : "json",
            data : {
                "id" : id,
                "status" : status,
            },
            success:function data(data){
                     console.log(data.success);
                 }

        });
    })

    $('.btn-editAgenda').on('click', function () {
        let id = $(this).data('id')
        let title = $(this).data('title')
        let url = $(this).data('url')
        let konten = $(this).data('konten')
        let photo = $(this).data('photo')
        let lokasi = $(this).data('lokasi')
        let tanggal = $(this).data('tanggal')
        let waktu = $(this).data('waktu')
        $('.title').val(title)
        $('.konten').val(konten)
        $('.photo').attr('src', photo )
        $('.url').attr('action', url )
        $('.lokasi').val(lokasi)
        $('.tanggal').val(tanggal)
        $('.waktu').val(waktu)
    })

</script>
@endsection

@section('modal')
<div class="modal fade" id="editAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Agenda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="url" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input name="id_user" type="text" value="{{auth()->user()->id}}" hidden >
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto</label>
                  <input type="file" name="photo" class="form-control " id="gambar" aria-describedby="emailHelp">
                  <img src="" class="photo" alt="" style="width: 100px">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control title" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <textarea name="konten" class="form-control konten" id="" cols="30" rows="10"></textarea>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Lokasi</label>
                  <input type="text" name="lokasi" class="form-control lokasi" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control tanggal" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Waktu</label>
                  <input type="text" name="waktu" class="form-control waktu" id="timepicker" aria-describedby="emailHelp">
                </div>

                {{-- <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
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

  {{-- Edit agenda --}}
  <div class="modal fade" id="tambahAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Agenda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('agendaWeb.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="id_user" type="text" value="{{auth()->user()->id}}" hidden >
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto</label>
                  <input type="file" name="photo" class="form-control" id="gambar" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <textarea name="konten" class="form-control" id="" cols="30" rows="10"></textarea>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Lokasi</label>
                  <input type="text" name="lokasi" class="form-control" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="konten" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Waktu</label>
                  <input type="text" name="waktu" class="form-control waktu" id="timepicker" aria-describedby="emailHelp">
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
@endsection
