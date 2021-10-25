@extends('layouts.main')

@section('content')
{{-- <div class="container"> --}}
    <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahKiriman">Tambah kiriman</a>
    <br>
    <table id="myTable" class="table display">
        <thead>
            <th>#</th>
            <th>User</th>
            <th>Gambar</th>
            <th>Konten</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            @foreach ($kiriman as $k)

            <tr>
                <td>{{ $no +=1 }}</td>
                <td>{{$k->user->name}}</td>
                <td><img src="{{asset('storage/'.$k->gambar)}}" style="width: 150px" alt=""></td>
                <td>{{$k->konten}}</td>
                <td>
                    <div class="d-flex">
                        <a href="" class="btn btn-warning mr-1 btn-editKiriman" data-toggle="modal" data-target="#editKiriman" data-id="{{$k->user}}" data-img="{{asset('storage/'.$k->gambar)}}" data-url="{{route('kiriman.update', $k->id)}}" data-konten="{{$k->konten}}"><i class="far fa-edit" ></i></a>
                        <form action="{{route('kiriman.destroy',$k->id)}}" method="POST">
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
{{-- </div> --}}


@endsection


@section('modal')
<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="editKiriman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="file" name="gambar" class="form-control" id="gambar" aria-describedby="emailHelp">
                  <img src="" class="gambar" alt="">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <input type="text" name="konten" class="form-control konten" id="konten" aria-describedby="emailHelp">
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

  {{-- Edit Kiriman --}}
  <div class="modal fade" id="tambahKiriman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('kiriman.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar" aria-describedby="emailHelp">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Konten</label>
                  <input type="text" name="konten" class="form-control" id="konten" aria-describedby="emailHelp">
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
@endsection
