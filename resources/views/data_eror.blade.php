@extends('layout.master')




@section('row')


<!-- Highlighting rows and columns -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Data Eror</h5>

        <div class="heading-elements">
            <button type="button" class="btn btn-primary btn-sm tombol-tambah" data-toggle="modal" data-target="#modal_theme_primary">Tambah Data <i class="icon-plus2 position-right"></i></button>
        </div>
    </div>




    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Rak Buku</th>
                <th>Data Sistem</th>
                <th>ID Barcode</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($eror as $e)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$e->id_buku}}</td>
                <td>{{$e->jdl_buku}}</td>
                <td>{{$e->rak_buku}}</td>
                <td>{{$e->data_sistem}}</td>
                <td>{{$e->id_barcode}}</td>  
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>


            <script type="text/javascript">
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function() {



                    // var error = $('.error').data('error');
                    // // console.log(error);
                    // if(error > 0){
                    //     $('#modal_theme_primary').modal('show');
                    // }


                    $('.tombol-tambah').click(function() {

                        $('#form').attr('action', '{{route("data_eror.store")}}');
                        $('#bungkus').html("");


                        $('.modal-title').html('Tambah Data');
                        
                        $('#id_buku').val('');
                        $('#jdl_buku').val('');
                        $('#rak_buku').val('');
                        $('#data_sistem').val('');
                        $('#id_barcode').val('');




                    });
                });
            </script>


            @endforeach

        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->




<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Tambah Data</h6>
            </div>

            <div class="modal-body">

            <!-- <div class="error" data-error="{{count($errors)}}"></div>


                {{-- menampilkan error validasi --}}
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->

                <form class="form-horizontal form-validate-jquery" id="form" action="{{route('data_eror.store')}}" method="post">
                    @csrf
                    <div id="bungkus"></div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">ID <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="id_buku" class="form-control" required="required" placeholder="ID" id="id_buku" value="{{old('id_buku')}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-3">Judul <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="jdl_buku" class="form-control" required="required" placeholder="Judul Buku" id="jdl_buku" value="{{old('jdl_buku')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Rak Buku <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="rak_buku" class="form-control" required="required" placeholder="Rak Bukuy" id="rak_buku" value="{{old('rak_buku')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Data Sistem <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="data_sistem" class="form-control" required="required" placeholder="Data Sistem" id="data_sistem" value="{{old('data_sistem')}}">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-lg-3">ID Barcode <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="id_barcode" class="form-control" required="required" placeholder="ID Barcode" id="id_barcode" value="{{old('id_barcode')}}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>


            </div>


        </div>
    </div>
</div>
<!-- /primary modal -->



@endsection


@section('page-header')

<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Data Buku</h4>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Data Buku</li>
    </ul>

</div>

@endsection