@extends('layouts.main')

@section('content')
<table id="myTable" class="table display">
    <thead>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        @foreach ($user as $u)

        <tr>
            <td>{{ $no +=1 }}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->email}} </td>
            <td>
                {{-- <form action="{{route('change-status', $u->id)}}" method="POST">
                    @csrf
                    @if ($u->status == 0)
                    <button type="submit" class="btn btn-danger" >Nonaktif</button>
                    @else
                    <button type="submit"  class="btn btn-success">Aktif</button>
                    @endif
                </form> --}}


                <label class="switch">

                    <input type="checkbox" class="status-switch" data-id="{{$u->id}}" {{$u->status != 0 ?  'checked' : ''}} {{$u->email_verified_at != null ? 'checked' : ''}}>
                    <span class="slider round"></span>
                </label>



                </td>
            <td>
                <div class="d-flex">
                    <a href="{{route('user.show', $u->id)}}" class="btn btn-info mr-1 edit-user"><i class="far fa-eye"></i></a>
                    <button href="" class="btn btn-warning mr-1 edit-user btn-editUser" data-toggle="modal" data-target="#editUser" data-name="{{$u->name}}" data-email="{{$u->email}}" data-url="{{route('user.update',$u->id)}}"><i class="far fa-edit"></i></button>
                    <form action="{{route('user.destroy', $u->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger delete-user" onclick="return confirm('apakah data ini akan dihapus?')"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="url" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control email">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Edit</button>
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
    // $(document).ready(function(){
        $('td .switch .status-switch').on('change', function () {
             let id = $(this).data('id');
             let status = $(this).prop('checked') == true ? 1 : 0;
             // $('.status-switch').load('changeStatus/'.id)
             console.log('coba');
             $.ajax({
                 url : "/changeStatus",
                 type : "GET",
                 dataType : 'json',
                 data : {
                     'id' : id,
                     'status' :status,
                 },
                 success:function data(data){
                     console.log(data.success);
                 }
                 // type : 'post',
                 //   dataType : 'json',
                 //   success : success
             });
         })
    // })

    $('.btn-editUser').on('click', function(){
        let name = $(this).data('name')
        let email= $(this).data('email')
        let url = $(this).data('url')
        $('.name').val(name)
        $('.url').attr('action', url)
        $('.email').val(email)
    })
</script>
@endsection
