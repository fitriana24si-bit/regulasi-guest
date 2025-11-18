<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\DokumenHukum;
use Illuminate\Database\Seeder;

class KategoriDokumenSeeder extends Seeder
{
    public function run()
    {
        // Buat data kategori
        $kategoris = [
            [
                'nama' => 'Peraturan Desa',
                'deskripsi' => 'Peraturan yang ditetapkan oleh pemerintah desa'
            ],
            [
                'nama' => 'Surat Edaran',
                'deskripsi' => 'Surat edaran dari kepala desa'
            ],
            [
                'nama' => 'Laporan',
                'deskripsi' => 'Laporan kegiatan dan keuangan desa'
            ],
            [
                'nama' => 'Anggaran',
                'deskripsi' => 'Dokumen anggaran pendapatan dan belanja desa'
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriDokumen::create($kategori);
        }

        // Ambil jenis dokumen yang sudah ada
        $jenisPerdes = JenisDokumen::where('nama_jenis', 'Perdes')->first();
        $jenisPerkades = JenisDokumen::where('nama_jenis', 'Perkades')->first();
        $jenisSE = JenisDokumen::where('nama_jenis', 'SE')->first();

        // Buat data dokumen hukum
        $dokumens = [
            [
                'id_jenis' => $jenisPerdes->id_jenis,
                'kategori_id' => 1, // Peraturan Desa
                'nomor' => '001/PERDES/2024',
                'judul' => 'Peraturan Desa tentang APBDes Tahun 2024',
                'tanggal' => '2024-01-15',
                'ringkasan' => 'Pengaturan Anggaran Pendapatan dan Belanja Desa Tahun 2024',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisPerkades->id_jenis,
                'kategori_id' => 2, // Surat Edaran
                'nomor' => '001/SE/2024',
                'judul' => 'Surat Edaran Kegiatan Gotong Royong',
                'tanggal' => '2024-02-01',
                'ringkasan' => 'Pengumuman kegiatan gotong royong bersih desa',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisSE->id_jenis,
                'kategori_id' => 3, // Laporan
                'nomor' => '002/SE/2024',
                'judul' => 'Laporan Bulanan Kegiatan Desa',
                'tanggal' => '2024-03-01',
                'ringkasan' => 'Laporan kegiatan desa bulan Februari 2024',
                'status' => 'aktif'
            ]
        ];

        foreach ($dokumens as $dokumen) {
            DokumenHukum::create($dokumen);
        }
    }
}
