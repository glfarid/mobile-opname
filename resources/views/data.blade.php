@extends('layout.master')



@section('row')

<!-- Highlighting rows and columns -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Data Buku Perpustakaan</h5>
		<div class="heading-elements">
			<button type="button" class="btn btn-primary btn-rounded tombol-tambah" data-toggle="modal" data-target="#modal_theme_primary">Tambah Data</button>
		</div>

	</div>


	<div class="flash-data" data-flashdata="{{Session::get('flash_data')}}"></div>



	<table class="table table-bordered table-hover datatable-highlight">
		<thead>
			<tr>
				<th>#</th>
				<th>ID</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Subject</th>
				<th>Penerbit</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $d)

			<tr>
				<th scope="row">{{$loop->iteration}}</th>
				<td>{{$d -> ID}}</td>
				<td>{{$d -> JUDUL}}</td>
				<td>{{$d -> PENGARANG}}</td>
				<td>{{$d -> SUBJEK}}</td>
				<td>{{$d -> PENERBIT}}</td>
				<td class="text-center">
					<div class="row">
						<div class="col-md-6">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{route('data.destroy',$d->ID)}}"><i class="icon-trash tombol-hapus"></i> Hapus Data</a></li>
										<li><a class="tombol-edit" href="#" data-toggle="modal" data-target="#modal_theme_primary" data-id="{{$d->ID}}"><i class="icon-pencil"></i> Ubah Data </a></li>


									</ul>

								</li>


							</ul>
						</div>
						<div class="col-md-6">
							<a href="{{route('print',$d->ID)}}" target="_blank">
								<i class="fa fa-print fa-lg"></i>
							</a>
 
						</div>

					</div>

				</td>

			</tr>

			<script type="text/javascript">
				$.ajaxSetup({

					headers: {

						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$(document).ready(function() {


					$('.tombol-hapus').click(function(e) {
						e.preventDefault();

						swal({
								title: "Are you sure?",
								text: "You will not be able to recover this imaginary file!",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#EF5350",
								confirmButtonText: "Yes, delete it!",
								cancelButtonText: "No, cancel pls!",
								closeOnConfirm: false,
								closeOnCancel: false
							},
							function(isConfirm) {
								if (isConfirm) {
									swal({
										title: "Deleted!",
										text: "Your imaginary file has been deleted.",
										confirmButtonColor: "#66BB6A",
										type: "success"
									});
								} else {
									swal({
										title: "Cancelled",
										text: "Your imaginary file is safe :)",
										confirmButtonColor: "#2196F3",
										type: "error"
									});
								}
							});

					});




					$('.tombol-tambah').click(function() {

						$('#form').attr('action', '{{route("data.store")}}');
						$('#bungkus').html("");


						$('.modal-title').html('Tambah Data');
						$('#ID').val('');
						$('#judul').val('');
						$('#pengarang').val('');
						$('#subjek').val('');
						$('#penerbit').val('');

						
						

					});


					$('.tombol-edit').click(function() {



						$('#bungkus').html("<input type='hidden' name='_method' value='PUT'>");
						var amblData = $(this).attr('data-id');
						var acction = $('#form').attr('action', '{{route("data.store")}}' + '/' + amblData);
						$.ajax({
							type: 'POST',
							url: '{{route("ajax")}}',
							data: {
								id: amblData
							},
							success: function(data) {
								$('.modal-title').html('Edit Data');
								$('#ID').val(data.ID);
								$('#judul').val(data.JUDUL);
								$('#pengarang').val(data.PENGARANG);
								$('#subjek').val(data.SUBJEK);
								$('#penerbit').val(data.PENERBIT);



							}

						});

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
				<h6 class="modal-title"></h6>
			</div>

			<div class="modal-body">

				<form class="form-horizontal form-validate-jquery" id="form" action="{{route('data.store')}}" method="post">
					@csrf
					<div id="bungkus"></div>
					<div class="form-group">
						<label class="control-label col-lg-3">ID <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="ID" class="form-control" required="required" placeholder="ID" id="ID">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-3">Judul <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="judul" class="form-control" required="required" placeholder="Judul Buku" id="judul">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-3">Pengarang <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="pengarang" class="form-control" required="required" placeholder="Pengarang Buku" id="pengarang">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-3">Subject <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="subjek" class="form-control" required="required" placeholder="Subject Buku" id="subjek">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-3">Penerbit <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" name="penerbit" class="form-control" required="required" placeholder="Penerbit Buku" id="penerbit">
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