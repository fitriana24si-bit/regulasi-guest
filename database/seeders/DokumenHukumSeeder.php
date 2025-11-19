<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\DokumenHukum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenHukumSeeder extends Seeder
{
    public function run()
    {
        // PERBAIKI: Gunakan 'dokumen_hukum' (tanpa s)
        DB::table('dokumen_hukum')->delete();

        // Ambil data yang sudah ada
        $jenisPerdes = JenisDokumen::where('nama_jenis', 'Perdes')->first();
        $jenisPerkades = JenisDokumen::where('nama_jenis', 'Perkades')->first();
        $jenisSE = JenisDokumen::where('nama_jenis', 'SE')->first();

        $kategoriPeraturan = KategoriDokumen::where('nama', 'Peraturan Desa')->first();
        $kategoriSuratEdaran = KategoriDokumen::where('nama', 'Surat Edaran')->first();
        $kategoriLaporan = KategoriDokumen::where('nama', 'Laporan')->first();
        $kategoriAnggaran = KategoriDokumen::where('nama', 'Anggaran')->first();

        $dokumens = [
            [
                'id_jenis' => $jenisPerdes->id_jenis,
                'kategori_id' => $kategoriAnggaran->kategori_id,
                'nomor' => '001/PERDES/2024',
                'judul' => 'Peraturan Desa tentang APBDes Tahun 2024',
                'tanggal' => '2024-01-15',
                'ringkasan' => 'Pengaturan Anggaran Pendapatan dan Belanja Desa Tahun 2024',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisPerkades->id_jenis,
                'kategori_id' => $kategoriSuratEdaran->kategori_id,
                'nomor' => '001/PERKADES/2024',
                'judul' => 'Peraturan Kepala Desa tentang Tata Tertib Pelayanan',
                'tanggal' => '2024-02-01',
                'ringkasan' => 'Pengaturan tata tertib pelayanan masyarakat di kantor desa',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisSE->id_jenis,
                'kategori_id' => $kategoriSuratEdaran->kategori_id,
                'nomor' => '001/SE/2024',
                'judul' => 'Surat Edaran Kegiatan Gotong Royong',
                'tanggal' => '2024-02-10',
                'ringkasan' => 'Pengumuman kegiatan gotong royong bersih desa',
                'status' => 'aktif'
            ]
        ];

        foreach ($dokumens as $dokumenData) {
            DokumenHukum::create($dokumenData);
        }

        $this->command->info('✅ Dokumen Hukum berhasil di-seed! (3 data dasar)');
    }
}
