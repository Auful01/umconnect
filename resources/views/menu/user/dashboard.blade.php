@extends('layouts.main')

@section('content')
        {{-- {{auth()->user()->id}} --}}
        <div class="row d-flex justify-content-around">
            <div class="card alert-success col-md-2 mr-1 mt-3" >
                <div class="card-body">
                    <h4 style="text-align: center">
                        <i class="fas fa-user nav-icon"></i>
                        <h4 style="text-align: center">User</h4>
                    <h4 style="text-align: center">{{$user}}</h4>
                    </h4>
                </div>
            </div>
            <div class="card alert-success col-md-2 mr-1 mt-3" >
                <div class="card-body">
                    <h4 style="text-align: center">
                        <i class="fas fa-comment-alt nav-icon"></i>
                        <h4 style="text-align: center">Kiriman</h4>
                    <h4 style="text-align: center">{{$kiriman}}</h4>
                    </h4>
                </div>
            </div>
            <div class="card alert-success col-md-2 mr-1 mt-3" >
                <div class="card-body">
                    <h4 style="text-align: center">
                        <i class="fas fa-list nav-icon"></i>
                        <h4 style="text-align: center">Layanan</h4>
                    <h4 style="text-align: center">{{$layanan}}</h4>
                    </h4>
                </div>
            </div>
            <div class="card alert-success col-md-2 mr-1 mt-3" >
                <div class="card-body">
                    <h4 style="text-align: center">
                        <i class="fas fa-box-open nav-icon"></i>
                        <h4 style="text-align: center">Produk</h4>
                    <h4 style="text-align: center">{{$produk}}</h4>
                    </h4>
                </div>
            </div>
            <div class="card alert-success col-md-2 mr-1 mt-3" >
                <div class="card-body">
                    <h4 style="text-align: center">
                        <i class="fas fa-calendar-alt nav-icon"></i>
                        <h4 style="text-align: center">Agenda</h4>
                    <h4 style="text-align: center">{{$agenda}}</h4>
                    </h4>
                </div>
            </div>
        </div>


        {{-- <div class="alert alert-success" role="alert">
            <h3><i class="fas fa-exclamation-circle"></i>&nbsp;Pengumuman</h3>
                <hr>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab nulla iusto maiores esse quis temporibus hic illo delectus nostrum molestias, fugiat non impedit doloremque laboriosam in minus, illum iste deleniti!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi itaque laboriosam cupiditate saepe dicta eveniet delectus quasi quod ad esse repellat, molestias praesentium cumque labore a recusandae corporis ullam?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur natus ex facilis expedita qui consectetur minus unde voluptates consequuntur fugit assumenda aliquid soluta quae eligendi, quisquam accusantium! Qui, deleniti obcaecati.
        </div>
        <br>
        <div class="alert alert-info" role="alert">
            <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3>
                <hr>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab nulla iusto maiores esse quis temporibus hic illo delectus nostrum molestias, fugiat non impedit doloremque laboriosam in minus, illum iste deleniti!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente animi itaque laboriosam cupiditate saepe dicta eveniet delectus quasi quod ad esse repellat, molestias praesentium cumque labore a recusandae corporis ullam?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur natus ex facilis expedita qui consectetur minus unde voluptates consequuntur fugit assumenda aliquid soluta quae eligendi, quisquam accusantium! Qui, deleniti obcaecati.
      </div> --}}


@endsection
