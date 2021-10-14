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
            <td>{{$u->email}}</td>
            <td>
                <label class="switch">
                    <input type="checkbox" onchange="" {{$u->status != 0 ?  'checked' : ''}} {{$u->email_verified_at != null ? 'checked' : ''}}>
                    <span class="slider round"></span>
                  </label>

                </td>
            <td>
                <div class="d-flex">
                    <a href="" class="btn btn-warning mr-1" ><i class="far fa-edit"></i></a>
                    <form action="">
                        <a href="" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
