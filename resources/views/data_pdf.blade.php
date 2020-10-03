<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5 target="_blank">Barcode Data Buku Perpustakaan</h4>
	</center>

	<div class="row">
      
        <div class="col-md 4 ml-5">
			{{$barcode->JUDUL}}
			<div>{!! DNS1D::getBarcodeHTML(strval($barcode->ID),'C128A',1,33,'blue') !!}</div>
        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5 target="_blank">Barcode Data Buku Perpustakaan</h4>
	</center>

	<div class="row">
      
        <div class="col-md 4 ml-5">
			{{$barcode->JUDUL}}
			<div>{!! DNS1D::getBarcodeHTML(strval($barcode->ID),'C128A',1,33,'blue') !!}</div>
        </div>

    </div>

</body>
</html>