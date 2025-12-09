<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\DokumenHukum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenHukumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Faker bahasa Indonesia

        DB::table('dokumen_hukum')->delete();

        // Ambil data yang sudah ada
        $jenisPerdes = JenisDokumen::where('nama_jenis', 'Perdes')->first();
        $jenisPerkades = JenisDokumen::where('nama_jenis', 'Perkades')->first();
        $jenisSE = JenisDokumen::where('nama_jenis', 'SE')->first();

        $kategoriPeraturan = KategoriDokumen::where('nama', 'Peraturan Desa')->first();
        $kategoriSuratEdaran = KategoriDokumen::where('nama', 'Surat Edaran')->first();
        $kategoriLaporan = KategoriDokumen::where('nama', 'Laporan')->first();
        $kategoriAnggaran = KategoriDokumen::where('nama', 'Anggaran')->first();

        // Data judul dokumen Indonesia yang realistis
        $judulPerdes = [
            'Peraturan Desa tentang Anggaran Pendapatan dan Belanja Desa',
            'Peraturan Desa tentang Tata Tertib Pemerintah Desa',
            'Peraturan Desa tentang Retribusi Pelayanan Publik',
            'Peraturan Desa tentang Pengelolaan Badan Usaha Milik Desa',
            'Peraturan Desa tentang Pembagian Hasil Pajak dan Retribusi',
            'Peraturan Desa tentang Penyelenggaraan Ketentraman dan Ketertiban',
            'Peraturan Desa tentang Pengelolaan Aset Desa',
            'Peraturan Desa tentang Pembentukan dan Susunan Organisasi Pemerintah Desa'
        ];

        $judulPerkades = [
            'Peraturan Kepala Desa tentang Penetapan Hari Libur Desa',
            'Peraturan Kepala Desa tentang Tata Cara Pelayanan Masyarakat',
            'Peraturan Kepala Desa tentang Pengelolaan Pasar Desa',
            'Peraturan Kepala Desa tentang Penyelenggaraan Kegiatan Kemasyarakatan',
            'Peraturan Kepala Desa tentang Penggunaan Tanah Kas Desa',
            'Peraturan Kepala Desa tentang Pembentukan Tim Penilai Kinerja'
        ];

        $judulSE = [
            'Surat Edaran tentang Pelaksanaan Gotong Royong Bulanan',
            'Surat Edaran tentang Pendataan Penduduk Miskin',
            'Surat Edaran tentang Pengumpulan Data untuk Bantuan Sosial',
            'Surat Edaran tentang Pelaksanaan Musyawarah Desa',
            'Surat Edaran tentang Pengisian Data Profil Desa',
            'Surat Edaran tentang Penyelenggaraan Kegiatan Hari Besar Nasional'
        ];

        // Data ringkasan Indonesia
        $ringkasanOptions = [
            'Pengaturan mengenai tata cara dan mekanisme penyelenggaraan pemerintahan desa',
            'Ketentuan tentang pengelolaan keuangan dan aset desa secara transparan',
            'Pedoman pelaksanaan kegiatan pembangunan dan pemberdayaan masyarakat',
            'Regulasi tentang hak dan kewajiban masyarakat dalam pembangunan desa',
            'Pengaturan sistem pelayanan publik kepada masyarakat desa',
            'Ketentuan tentang partisipasi masyarakat dalam musyawarah desa',
            'Pedoman teknis pelaksanaan program kerja pemerintah desa',
            'Pengaturan mekanisme pengawasan dan pertanggungjawaban kegiatan desa'
        ];

        // Data dasar
        $dokumens = [
            [
                'id_jenis' => $jenisPerdes->id_jenis,
                'kategori_id' => $kategoriAnggaran->kategori_id,
                'nomor' => '001/PERDES/2024',
                'judul' => 'Peraturan Desa tentang Anggaran Pendapatan dan Belanja Desa Tahun 2024',
                'tanggal' => '2024-01-15',
                'ringkasan' => 'Pengaturan mengenai penyusunan, penetapan, dan pelaksanaan anggaran pendapatan dan belanja desa tahun 2024',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisPerkades->id_jenis,
                'kategori_id' => $kategoriSuratEdaran->kategori_id,
                'nomor' => '005/PERKADES/2024',
                'judul' => 'Peraturan Kepala Desa tentang Tata Tertib Pelayanan Masyarakat',
                'tanggal' => '2024-02-01',
                'ringkasan' => 'Ketentuan tentang standar pelayanan, prosedur, dan waktu penyelesaian pelayanan kepada masyarakat',
                'status' => 'aktif'
            ],
            [
                'id_jenis' => $jenisSE->id_jenis,
                'kategori_id' => $kategoriSuratEdaran->kategori_id,
                'nomor' => '012/SE/2024',
                'judul' => 'Surat Edaran tentang Pelaksanaan Kegiatan Gotong Royong',
                'tanggal' => '2024-02-10',
                'ringkasan' => 'Petunjuk pelaksanaan kegiatan gotong royong bersih-bersih lingkungan desa secara serentak',
                'status' => 'aktif'
            ]
        ];

       
        foreach (range(1, 100) as $index) {
            $jenis = $faker->randomElement([$jenisPerdes, $jenisPerkades, $jenisSE]);
            $kategori = $faker->randomElement([$kategoriPeraturan, $kategoriSuratEdaran, $kategoriLaporan, $kategoriAnggaran]);

            // Tentukan judul berdasarkan jenis dokumen
            if ($jenis->nama_jenis == 'Perdes') {
                $judul = $faker->randomElement($judulPerdes) . ' Tahun ' . $faker->year;
            } elseif ($jenis->nama_jenis == 'Perkades') {
                $judul = $faker->randomElement($judulPerkades);
            } else {
                $judul = $faker->randomElement($judulSE);
            }

            $dokumens[] = [
                'id_jenis' => $jenis->id_jenis,
                'kategori_id' => $kategori->kategori_id,
                'nomor' => sprintf('%03d/%s/%d', $faker->numberBetween(1, 150), $jenis->nama_jenis, $faker->numberBetween(2020, 2024)),
                'judul' => $judul,
                'tanggal' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'ringkasan' => $faker->randomElement($ringkasanOptions),
                'status' => $faker->randomElement(['aktif', 'tidak_aktif']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($dokumens as $dokumenData) {
            DokumenHukum::create($dokumenData);
        }

        $this->command->info('✅ Dokumen Hukum berhasil di-seed! Data Indonesia');
    }
}
