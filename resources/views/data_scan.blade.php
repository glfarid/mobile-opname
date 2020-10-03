@extends('layout.master')

@section('row')



					<!-- Basic datatable -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Basic datatable</h5>
							
						</div>

			
						<table class="table datatable-basic">
							<thead>
								<tr>
                                    <th>NO</th>
									<th>ID</th>
									<th>Jumlah</th>
									<th>Judul</th>
									<th>Peminjaman</th>
									<th>Data Fisik</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $d)
								<tr>
                                <th scope="row">{{$loop->iteration}}</th>
									<td>{{$d->ID}}</td>
									<td>{{$d->jumlah}}</td>
									<td>{{$d->judul}}</td>
									<td>
                                        <textarea>{{$d->peminjaman}}</textarea>
                                    </td>
									<td>
                                        <textarea>{{$d->data_fisik}}</textarea>
                                    </td>
							
                                </tr>
                                
                                @endforeach
							
							</tbody>
						</table>
					</div>
					<!-- /basic datatable -->






@endsection

@section('page-header')

<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Data Scan Buku</h4>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Data Scan Buku</li>
    </ul>

</div>

@endsection

