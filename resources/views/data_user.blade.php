@extends('layout.master')

@section('row')

			<!-- Highlighting rows and columns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Data User</h5>
              
                </div>


                <table class="table datatable-show-all">
                    <thead>
                    
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>NRP</th>
                            <th>Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $u)
                            
          
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$u->name}}</td>
                        <td>{{$u->username}}</td>
                        <td>{{$u->phone}}</td>
                        <td>{{$u->nrp}}</td>
                        <td>{{$u->created_at}}</td>
                            <td class="text-center">

                        <form action="{{ route('data_user.destroy', $u->id) }}" method="POST">
                            @csrf
                             @method('delete')
                                   
                                <button type="submit" class="btn btn-danger"> <i class="icon-trash"></i></a></button>
                        </form>
                            </td>
                        </tr>

                        @endforeach
                   </tbody>
                </table>
            </div>
            <!-- /highlighting rows and columns -->

@endsection


@section('page-header')

<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Data Buku</h4>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Data User</li>
    </ul>

</div>

@if (Session::has('alert-success'))

<div class="alert bg-success alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">{{Session::get('alert-success')}}</span>
</div>
    
@endif

@endsection