<?php

use Illuminate\Database\Seeder;
use App\Sekolah;
use App\Tanah;
use App\Bangunan;
use App\Ruang;
use App\Alat;
use App\Angkutan;
use App\Buku;

class IsianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alat')->delete();
        DB::table('ruang')->delete();
        DB::table('bangunan')->delete();
        DB::table('tanah')->delete();
        $sekolah = Sekolah::first();
        $insert_tanah = Tanah::create([
            'sekolah_id' => $sekolah->sekolah_id,
            'nama' => 'Tanah Utama',
            'no_sertifikat_tanah' => '123',
            'panjang' => 0,
            'lebar' => 0,
            'luas' => 0,
            'luas_lahan_tersedia' => 0,
            'kepemilikan_sarpras_id' => 1,
            'keterangan' => 'keterangan',
        ]);
        $insert_bangunan = Bangunan::create([
            'tanah_id' => $insert_tanah->tanah_id,
            'nama' => 'Bangunan Utama',
            'imb' => '123',
            'panjang' => 0,
            'lebar' => 0,
            'luas' => 0,
            'lantai' => 0,
            'kepemilikan_sarpras_id' => 1,
            'tahun_bangun' => '2020',
            'tanggal_sk' => date('Y-m-d'),
            'keterangan' => 'keterangan',
        ]);
        $insert_ruang = Ruang::create([
            'bangunan_id' => $insert_bangunan->bangunan_id,
            'jenis_prasarana_id' => 1,
            'kode' => 'K-1',
            'nama' => 'Kelas 1',
            'registrasi' => 'registrasi',
            'lantai_ke' => 1,
            'panjang' => 0,
            'lebar' => 0,
            'luas' => 0,
            'keterangan' => 'keterangan',
        ]);
        $insert_alat = Alat::create([
            'jenis_sarana_id' => 1,
            'ruang_id' => $insert_ruang->ruang_id,
            'nama' => 'Bangku Siswa',
            'spesifikasi' => 'Kayu Jati Peninggalan Majapahit',
            'kepemilikan_sarpras_id' => 1,
            'keterangan' => 'keterangan',
        ]);
        $insert_angkutan = Angkutan::create([
            'jenis_sarana_id' => 10001,
            'sekolah_id' => $sekolah->sekolah_id,
            'nama' => 'FIZ R',
            'spesifikasi' => 'Motor Racing 2 Tak',
            'merk' => 'Yamaha',
            'no_polisi' => 'M 4454 DI',
            'no_bpkb' => 'ABCDEFGH',
            'alamat' => $sekolah->alamat,
            'kepemilikan_sarpras_id' => 1,
            'keterangan' => 'keterangan',
        ]);
        $insert_buku = Buku::create([
            'sekolah_id' => $sekolah->sekolah_id,
            'kode' => 'BI-0001',
            'judul' => 'Bahasa Inggris Kelas 7 Kurikulum 2013',
            'mata_pelajaran_id' => '100010000',
            'nama_penerbit' => 'Airlangga',
            'isbn_issn' => '1234567890',
            'kelas' => 7,
            'keterangan' => 'keterangan',
        ]);
    }
}
