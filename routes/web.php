<?php





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;





Route::get('/test', 'DownloadData@index')->name('printdata');

Route::get('/', function () {


    // INI UNTUK TERSEDIA(sebelum diolah)
    $datasesi =  DB::select(DB::raw("
    SELECT GROUP_CONCAT(id_barcode) as data_fisik, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman
    FROM data_fisik 
    LEFT JOIN peminjaman on peminjaman.ID_PUSTAKA LIKE concat('%',id_buku,'%') AND peminjaman.STATUS = 'pinjam'
    WHERE id_barcode LIKE concat('%',id_buku,'%') GROUP BY sesi 
    "));

    //SAMA INI
    $datapustaka =  DB::select(DB::raw("SELECT ID, JUMLAH FROM pustaka GROUP BY ID
    "));

    $datalengkap = [];

    foreach ($datapustaka as $dt) {
        $new_array = range(1, $dt->JUMLAH);
        foreach ($new_array as $n) {
            array_push($datalengkap, $dt->ID . '.' . $n);
        }
    }


    // $arr = [];
    $arr2 = [];
    $count = 1;
    foreach ($datasesi as $d) {
        array_push($arr2, [
            'Sesi' => $count++,
            'Tersedia' => Helper::dataada($d->peminjaman, $d->data_fisik),
            'Tidak Tersedia' => array_diff($datalengkap, Helper::dataada($d->peminjaman, $d->data_fisik))
        ]);
    }



    return view('index');
});


Route::get('/graph', function () {

    $datasesi =  DB::select(DB::raw("
SELECT GROUP_CONCAT(id_barcode) as data_fisik, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman
FROM data_fisik 
LEFT JOIN peminjaman on peminjaman.ID_PUSTAKA LIKE concat('%',id_buku,'%') AND peminjaman.STATUS = 'pinjam'
WHERE id_barcode LIKE concat('%',id_buku,'%') GROUP BY sesi 
"));

    //SAMA INI
    $datapustaka =  DB::select(DB::raw("SELECT ID, JUMLAH FROM pustaka GROUP BY ID
"));


    $datalengkap = collect($datapustaka)->map(function ($value) {
        $newarray = range(1, $value->JUMLAH);

        $databaru = collect($newarray)->map(function ($val) use ($value) {
            return $value->ID . '.' . $val;
        });


        return $databaru->implode(',');
    });



    $explode = collect(explode(',', $datalengkap->implode(',')));



    $arr2 = collect($datasesi)->map(function ($val, $i) use ($explode) {
        return [
            'Sesi' => $i + 1,
            'Tersedia' => Helper::dataada($val->peminjaman, $val->data_fisik),
            'ttsd' => $explode->diff(Helper::dataada($val->peminjaman, $val->data_fisik))->all()
        ];
    });


    return response()->json($arr2);
})->name('getajax');


Route::get('/sheet', function () {

    $datasesi =  DB::select(DB::raw("
    SELECT GROUP_CONCAT(id_barcode) as data_fisik, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman
    FROM data_fisik 
    LEFT JOIN peminjaman on peminjaman.ID_PUSTAKA LIKE concat('%',id_buku,'%') AND peminjaman.STATUS = 'pinjam'
    WHERE id_barcode LIKE concat('%',id_buku,'%')  AND sesi LIKE concat ('%', sesi,'%') GROUP BY sesi  
    "));

    //SAMA INI
    $datapustaka =  DB::select(DB::raw("SELECT ID, JUMLAH FROM pustaka GROUP BY ID
    "));


    // dd($datapustaka);

    $datalengkap = collect($datapustaka)->map(function ($value) {
        $newarray = range(1, $value->JUMLAH);


        $databaru = collect($newarray)->map(function ($val) use ($value) {
            return $value->ID . '.' . $val;
        });

        return $databaru->implode(',');
    });


    $explode = collect(explode(',', $datalengkap->implode(',')));



    $arr2 = collect($datasesi)->map(function ($val, $i) use ($explode) {
        return [
            'Sesi' => $i + 1,
            'Tersedia' => Helper::dataada($val->peminjaman, $val->data_fisik),
            'Tidak Ada' => $explode->diff(Helper::dataada($val->peminjaman, $val->data_fisik))->all()
        ];
    });



    $print = [];
    foreach ($arr2 as $mp) {
        if (count($mp['Tidak Ada']) > count($mp['Tersedia'])) {

            foreach ($mp['Tidak Ada'] as $key => $ttsd) {

                array_push($print, [
                    'Sesi' => $mp['Sesi'],
                    'Tersedia' => (array_key_exists($key, $mp['Tersedia'])) ? $mp['Tersedia'][$key] : '',
                    'Tidak Ada' => $ttsd

                ]);
            }
        } else {

            foreach ($mp['Tidak Ada'] as $key => $ttsd) {

                array_push($print, [
                    'Sesi' => $mp['Sesi'],
                    'Tersedia' => $ttsd,
                    'Tidak Ada' => (array_key_exists($key, $mp['Tidak Ada'])) ? $mp['Tidak Ada'][$key] : ''

                ]);
            }
        }
    }


    // dd($print);

    return response()->json($print);
})->name('getSheet');



Route::resource('/data', 'DataController')->except('destroy');
Route::GET('data/{data}', 'DataController@destroy')->name('data.destroy');
Route::post('ajaxRequestData', 'DataController@ajaxRequestPost')->name('ajax');
Route::GET('data/cetak_pdf/{ID}', 'DataController@cetakpdf')->name('print');



//Route Data Scan Buku
Route::resource('/data_scan', 'ReportController');
Route::post('ajaxRequest', 'ScanBukuController@ajaxRequestPost')->name('ajaxScan');
Route::GET('data_scan/{data_scan}', 'ScanBukuController@destroy')->name('data_scan.destroy');


//Route Opname
Route::resource('/opname', 'DataFisikController');
Route::GET('/opname/{id}', 'DataFisikController@destroy');
Route::GET('/joinTable/{id_buku}', 'DataFisikController@joinTable');





//Route Data Eror
Route::resource('/data_eror', 'DataErorController');

Route::resource('/data_user', 'UserControllerBlade');
