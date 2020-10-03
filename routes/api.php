<?php

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('all', 'API\UserController@all');

Route::apiResource('/data', 'ApiDataController');
Route::apiResource('/opname', 'ApiDataFisikController');


Route::apiResource('/peminjaman', 'ApiPeminjaman');
Route::apiResource('/sesi', 'ApiSesi');

Route::apiResource('/rak', 'ApiRakBuku');



// // API UJIAN ANDRROID
// Route::apiResource('/login', 'ApiLogin');
// Route::apiResource('/insert', 'ApiInsertLogin');

// Route::apiResource('/question', 'ApiQuestion');
// Route::apiResource('/note', 'ApiNoteTable');






Route::get('/tersedia', function () {
    $data = DB::select(DB::raw("
    SELECT pustaka.ID ,pustaka.JUMLAH as jumlah,
    pustaka.JUDUL as judul, GROUP_CONCAT(peminjaman.ID_PUSTAKA)
    as peminjaman, GROUP_CONCAT(data_fisik.id_barcode) as data_fisik FROM pustaka
    LEFT JOIN data_fisik ON data_fisik.id_buku = pustaka.ID LEFT JOIN peminjaman ON peminjaman.ID_PUSTAKA
    LIKe concat('%',pustaka.ID, '%') AND peminjaman.STATUS = 'pinjam' GROUP BY pustaka.ID 
    "));



    $arr = [];
    foreach ($data as $d) {
        $testing = Helper::dataada($d->peminjaman, $d->data_fisik);

        array_push($arr, [
            'ID' => $d->ID,
            'Tersedia' => $testing,
            'Tidak Tersedia' => Helper::caridata($testing, $d->jumlah)



        ]);
    }


    $tersedia = [
        count(array_merge(...array_column($arr, 'Tersedia'))),
        count(array_merge(...array_column($arr, 'Tidak Tersedia')))

    ];


    return $tersedia;
});
