@extends('layout.master')




@section('row')


<!-- Highlighting rows and columns -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Opname Mobile</h5>

        <!-- <div class="heading-elements">
            <button type="button" class="btn btn-primary btn-sm tombol-tambah" data-toggle="modal" data-target="#modal_theme_primary">Tambah Data <i class="icon-plus2 position-right"></i></button>
        </div> -->
    </div>




    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Rak Buku</th>
                <th>Ket</th>
                <th>Status</th>
                <th>Sesi</th>
                <th>Jumlah Asli</th>
                <th>ID Barcode</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($opname as $o)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$o -> id_buku}}</td>
                <td>{{$o -> jdl_buku}}</td>
                <td>{{$o -> rak_buku}}</td>
                <td>{{$o -> ket}}</td>
                <td><span class="label {{ strtolower($o->status) !=  'terdaftar'? 'label-danger':'label-success'}}">{{$o -> status}}</span></td>
                <td>{{$o -> sesi}}</td>
                <td>{{$o -> jmlh_asli}}</td>
                <td>{{$o -> id_barcode}}</td>
                <td class="text-center">
                   
                   <form action="{{ route('opname.destroy', $o->id) }}" method="POST">
                   @csrf
                   @method('delete')
                  
                            <button type="submit" class="btn btn-danger btn-sm"> <i class="icon-trash"></i></a></button>
                    </form>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$o->id}}"> <i class="icon-pen mt-2"></i></button>

                              
                   
                </td>
            </tr>

                    <!-- Horizontal form modal -->
            <div id="{{$o->id}}" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Update Data Opname</h5>
								</div>

								<form action={{route('opname.update',$o->id)}} method="POST" class="form-horizontal">
                                    @method('patch')
                                    @csrf

									<div class="modal-body">
										<div class="form-group">
											<label class="control-label col-sm-3">ID Buku</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="id_buku" value="{{$o->id_buku}}">
											</div>
                                        </div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">Judul Buku</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="jdl_buku" value="{{$o->jdl_buku}}">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">Rak Buku</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="rak_buku" value="{{$o->rak_buku}}">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">Ket Buku</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="ket" value="{{$o->ket}}">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">Sesi Buku</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="sesi" value="{{$o->sesi}}">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">Jumlah Asli</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="jmlh_asli" value="{{$o->jmlh_asli}}">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-3">ID Barcode</label>
											<div class="col-sm-9">
                                            <input type="text" class="form-control" name="id_barcode" value="{{$o->id_barcode}}">
											</div>
										</div>
                                        

									</div> 

									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update Data</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /horizontal form modal -->
        
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
        <li class="active">Data Buku</li>
    </ul>

</div>

@if (Session::has('alert-success'))

<div class="alert bg-success alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">{{Session::get('alert-success')}}</span>
</div>
    
@endif


@endsection