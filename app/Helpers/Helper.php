<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helper
{


    // public static function caridata($list, $max)
    // {
    //     $DADA = [];
    //     foreach ($list as $a) {
    //         if (strpos($a, '.')) {
    //             array_push($DADA, explode('.', $a)[1]);
    //         }
    //     }
    //     if (isset($DADA)) {
    //         $new_array = range(1, $max);
    //         return array_diff($new_array, $DADA);
    //     } else {
    //         return [];
    //     }
    // }


    public static function dataada($penjam, $fisik)
    {


        $fisik == null ? $datafisik = [] : $datafisik = array_unique(explode(',', $fisik));


        $penjam == null ? $peminjaman = array_unique($datafisik) :   $peminjaman  =  array_unique(array_merge($datafisik, explode(',', $penjam)));

        return $peminjaman;
    }


    public static function addcsv($arr, $name)
    {

        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$name");
        header("Pragma: no-cache");
        header("Expires: 0");
        $output = fopen("php://output", "a");
        $header = array_keys($arr[0]);
        fputcsv($output, $header);
        foreach ($arr as $item) {
            fputcsv($output, $item);
        }


        fclose($output);
    }
}
