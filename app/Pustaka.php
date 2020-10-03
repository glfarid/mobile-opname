<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pustaka extends Model
{
    protected $table = "pustaka";
 
 //  protected $fillable = ['id','JUDUL','PENGARANG','SUBJEK','PENERBIT'];

     public $timestamps = false;

   protected $guarded =['JENIS','JUDULASLI','ALIBAHASA','EDITOR','ILUSTRATOT','KLASIFIKASI','KODE','MONOGRAFI','KOLASI','IMPRESUM','KOTATERBIT','EDISI','CETAKAN','HALAMAN','DIMENSI','TERBIT','ISBN','ABSTRAK','DENDA','PINJAM','GAMBAR','FILE','JUMLAH','TERSEDIA','FORMAT_TGL','KETERANGAN','BARCODE','JENISPENGARANG','BAHASA','BIAYAPINJAM','NPM','NAMAMAHASISWA','PEMBIMBING','TANGGALLULUS','JENISKOLEKSI','BKU','HOMEPAGEPENERBIT','EMAILPENERBIT','JENISJURNAL','FREKUENSI','STATUSAKREDITASI','NOMORAKREDITASI','MULAI','AKHIR','SUMBER','KATAKUNCI','PEMBIMBING1','PEMBIMBING2','ALAMATPENERBIT','DISTRIBUTOR','FISIK','SERI','TANGGALUPDATE','UPDATER','STATUSBACA','RUSAK','HILANG','JUMLAH2','HILANG2','CATATAN'];


   public function datafisik(){
    return $this->hasMany(DataFisik::class,'id_buku','ID');
   }

   public function peminjaman(){
    return $this->hasMany(Peminjaman::class,'ID_PUSTAKA','LIKE concat(pustaka.ID%)');
   }

   public function peminjaman_like()
   {
     return $this->peminjaman();
   }

    
}


