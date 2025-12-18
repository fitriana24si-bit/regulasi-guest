<?php

namespace Database\Seeders;

use App\Models\KategoriDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KategoriDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $this->command->info('🔄 Membuat data dummy kategori dokumen...');

        // Data dasar yang sudah ada (tetap dipertahankan)
        $kategorisDasar = [
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
            ],
            [
                'nama' => 'Administrasi',
                'deskripsi' => 'Dokumen administrasi pemerintahan desa'
            ],
            [
                'nama' => 'Kependudukan',
                'deskripsi' => 'Dokumen terkait kependudukan'
            ]
        ];

        // Data tambahan untuk mencapai 100
        $kategorisTambahan = [
            // Kategori Peraturan & Hukum
            ['nama' => 'Peraturan Daerah', 'deskripsi' => 'Peraturan hukum yang berlaku di daerah kabupaten/kota'],
            ['nama' => 'Peraturan Bupati', 'deskripsi' => 'Peraturan yang dikeluarkan oleh bupati'],
            ['nama' => 'Peraturan Walikota', 'deskripsi' => 'Peraturan yang dikeluarkan oleh walikota'],
            ['nama' => 'Peraturan Gubernur', 'deskripsi' => 'Peraturan yang dikeluarkan oleh gubernur'],
            ['nama' => 'Peraturan Menteri', 'deskripsi' => 'Peraturan yang dikeluarkan oleh menteri'],
            ['nama' => 'Peraturan Presiden', 'deskripsi' => 'Peraturan yang dikeluarkan oleh presiden'],
            ['nama' => 'Undang-Undang', 'deskripsi' => 'Produk hukum yang dibuat oleh DPR dan presiden'],
            ['nama' => 'Peraturan Pemerintah', 'deskripsi' => 'Peraturan yang dibuat oleh pemerintah'],
            ['nama' => 'Keputusan Presiden', 'deskripsi' => 'Keputusan resmi yang dikeluarkan presiden'],
            ['nama' => 'Keputusan Menteri', 'deskripsi' => 'Keputusan resmi yang dikeluarkan menteri'],

            // Kategori Surat & Komunikasi
            ['nama' => 'Surat Keputusan', 'deskripsi' => 'Surat keputusan resmi pemerintah'],
            ['nama' => 'Surat Perintah', 'deskripsi' => 'Surat yang berisi perintah resmi'],
            ['nama' => 'Surat Tugas', 'deskripsi' => 'Surat penugasan untuk pegawai'],
            ['nama' => 'Surat Keterangan', 'deskripsi' => 'Surat keterangan resmi dari pemerintah'],
            ['nama' => 'Surat Pengantar', 'deskripsi' => 'Surat pengantar untuk keperluan administrasi'],
            ['nama' => 'Surat Undangan', 'deskripsi' => 'Surat undangan rapat atau acara'],
            ['nama' => 'Surat Pemberitahuan', 'deskripsi' => 'Surat pemberitahuan resmi'],
            ['nama' => 'Surat Pernyataan', 'deskripsi' => 'Surat pernyataan resmi'],
            ['nama' => 'Surat Kuasa', 'deskripsi' => 'Surat pemberian kuasa'],
            ['nama' => 'Nota Dinas', 'deskripsi' => 'Nota dinas internal pemerintah'],

            // Kategori Laporan & Evaluasi
            ['nama' => 'Laporan Keuangan', 'deskripsi' => 'Laporan posisi keuangan instansi'],
            ['nama' => 'Laporan Kegiatan', 'deskripsi' => 'Laporan pelaksanaan kegiatan'],
            ['nama' => 'Laporan Tahunan', 'deskripsi' => 'Laporan kinerja tahunan'],
            ['nama' => 'Laporan Bulanan', 'deskripsi' => 'Laporan kegiatan bulanan'],
            ['nama' => 'Laporan Triwulan', 'deskripsi' => 'Laporan periode tiga bulan'],
            ['nama' => 'Laporan Semester', 'deskripsi' => 'Laporan periode enam bulan'],
            ['nama' => 'Laporan Akhir', 'deskripsi' => 'Laporan akhir proyek/kegiatan'],
            ['nama' => 'Laporan Progress', 'deskripsi' => 'Laporan perkembangan pekerjaan'],
            ['nama' => 'Laporan Audit', 'deskripsi' => 'Laporan hasil pemeriksaan'],
            ['nama' => 'Laporan Evaluasi', 'deskripsi' => 'Laporan hasil evaluasi program'],

            // Kategori Anggaran & Keuangan
            ['nama' => 'APBDes', 'deskripsi' => 'Anggaran Pendapatan dan Belanja Desa'],
            ['nama' => 'APBD', 'deskripsi' => 'Anggaran Pendapatan dan Belanja Daerah'],
            ['nama' => 'RAB', 'deskripsi' => 'Rencana Anggaran Biaya'],
            ['nama' => 'DIPA', 'deskripsi' => 'Daftar Isian Pelaksanaan Anggaran'],
            ['nama' => 'RKAKL', 'deskripsi' => 'Rencana Kebutuhan Anggaran Kementerian/Lembaga'],
            ['nama' => 'Belanja Modal', 'deskripsi' => 'Dokumen pengeluaran untuk aset tetap'],
            ['nama' => 'Belanja Operasional', 'deskripsi' => 'Dokumen pengeluaran operasional'],
            ['nama' => 'Belanja Pegawai', 'deskripsi' => 'Dokumen pengeluaran untuk gaji dan tunjangan'],
            ['nama' => 'Pendapatan Asli', 'deskripsi' => 'Dokumen pendapatan asli daerah/desa'],
            ['nama' => 'Bantuan Keuangan', 'deskripsi' => 'Dokumen bantuan keuangan dari pusat'],

            // Kategori Administrasi & Umum
            ['nama' => 'Administrasi Kepegawaian', 'deskripsi' => 'Dokumen administrasi kepegawaian'],
            ['nama' => 'Administrasi Umum', 'deskripsi' => 'Dokumen administrasi umum pemerintahan'],
            ['nama' => 'Administrasi Keuangan', 'deskripsi' => 'Dokumen administrasi keuangan'],
            ['nama' => 'Administrasi Asset', 'deskripsi' => 'Dokumen administrasi barang milik daerah'],
            ['nama' => 'Administrasi Perizinan', 'deskripsi' => 'Dokumen administrasi perizinan'],
            ['nama' => 'Berkas Pegawai', 'deskripsi' => 'Berkas kepegawaian dan personalia'],
            ['nama' => 'Arsip', 'deskripsi' => 'Dokumen arsip pemerintah'],
            ['nama' => 'Notulen Rapat', 'deskripsi' => 'Catatan hasil rapat resmi'],
            ['nama' => 'Berita Acara', 'deskripsi' => 'Berita acara kegiatan/rapat'],
            ['nama' => 'Daftar Hadir', 'deskripsi' => 'Daftar hadir peserta rapat/kegiatan'],

            // Kategori Kependudukan & Sipil
            ['nama' => 'Kartu Keluarga', 'deskripsi' => 'Dokumen kartu keluarga'],
            ['nama' => 'KTP', 'deskripsi' => 'Dokumen Kartu Tanda Penduduk'],
            ['nama' => 'Akta Kelahiran', 'deskripsi' => 'Dokumen akta kelahiran'],
            ['nama' => 'Akta Kematian', 'deskripsi' => 'Dokumen akta kematian'],
            ['nama' => 'Akta Nikah', 'deskripsi' => 'Dokumen akta pernikahan'],
            ['nama' => 'Surat Pindah', 'deskripsi' => 'Surat keterangan pindah domisili'],
            ['nama' => 'Surat Domisili', 'deskripsi' => 'Surat keterangan domisili'],
            ['nama' => 'Surat Tidak Mampu', 'deskripsi' => 'Surat keterangan tidak mampu'],
            ['nama' => 'Surat Keterangan Usaha', 'deskripsi' => 'Surat keterangan usaha'],
            ['nama' => 'Data Penduduk', 'deskripsi' => 'Kumpulan data kependudukan'],

            // Kategori Pembangunan & Infrastruktur
            ['nama' => 'Dokumen Pembangunan', 'deskripsi' => 'Dokumen perencanaan pembangunan'],
            ['nama' => 'Rencana Pembangunan', 'deskripsi' => 'Dokumen rencana pembangunan jangka menengah'],
            ['nama' => 'Rencana Kerja', 'deskripsi' => 'Dokumen rencana kerja pemerintah'],
            ['nama' => 'Studi Kelayakan', 'deskripsi' => 'Dokumen studi kelayakan proyek'],
            ['nama' => 'AMDAL', 'deskripsi' => 'Analisis Mengenai Dampak Lingkungan'],
            ['nama' => 'Rencana Tata Ruang', 'deskripsi' => 'Dokumen rencana tata ruang wilayah'],
            ['nama' => 'Gambar Teknik', 'deskripsi' => 'Dokumen gambar teknik bangunan'],
            ['nama' => 'Spesifikasi Teknis', 'deskripsi' => 'Dokumen spesifikasi teknis pekerjaan'],
            ['nama' => 'Rencana Anggaran', 'deskripsi' => 'Dokumen rencana anggaran proyek'],
            ['nama' => 'Laporan Pembangunan', 'deskripsi' => 'Laporan progress pembangunan'],

            // Kategori Pengadaan & Kontrak
            ['nama' => 'Dokumen Pengadaan', 'deskripsi' => 'Dokumen proses pengadaan barang/jasa'],
            ['nama' => 'Kontrak Kerja', 'deskripsi' => 'Dokumen kontrak pekerjaan'],
            ['nama' => 'SPK', 'deskripsi' => 'Surat Perintah Kerja'],
            ['nama' => 'BAST', 'deskripsi' => 'Berita Acara Serah Terima'],
            ['nama' => 'RUP', 'deskripsi' => 'Rencana Umum Pengadaan'],
            ['nama' => 'Dokumen Tender', 'deskripsi' => 'Dokumen lelang/tender'],
            ['nama' => 'KAK', 'deskripsi' => 'Kerangka Acuan Kerja'],
            ['nama' => 'HPS', 'deskripsi' => 'Harga Perkiraan Sendiri'],
            ['nama' => 'RKS', 'deskripsi' => 'Rencana Kerja dan Syarat-syarat'],
            ['nama' => 'Berita Acara Pembukaan', 'deskripsi' => 'Berita acara pembukaan penawaran'],

            // Kategori Lainnya
            ['nama' => 'Dokumen Sosial', 'deskripsi' => 'Dokumen program sosial masyarakat'],
            ['nama' => 'Dokumen Pendidikan', 'deskripsi' => 'Dokumen bidang pendidikan'],
            ['nama' => 'Dokumen Kesehatan', 'deskripsi' => 'Dokumen bidang kesehatan'],
            ['nama' => 'Dokumen Pertanian', 'deskripsi' => 'Dokumen bidang pertanian'],
            ['nama' => 'Dokumen Perikanan', 'deskripsi' => 'Dokumen bidang perikanan'],
            ['nama' => 'Dokumen Perdagangan', 'deskripsi' => 'Dokumen bidang perdagangan'],
            ['nama' => 'Dokumen Industri', 'deskripsi' => 'Dokumen bidang industri'],
            ['nama' => 'Dokumen Pariwisata', 'deskripsi' => 'Dokumen bidang pariwisata'],
            ['nama' => 'Dokumen Lingkungan', 'deskripsi' => 'Dokumen pengelolaan lingkungan'],
            ['nama' => 'Dokumen Bencana', 'deskripsi' => 'Dokumen penanggulangan bencana'],
            ['nama' => 'Dokumen Pemuda', 'deskripsi' => 'Dokumen program kepemudaan'],
            ['nama' => 'Dokumen Olahraga', 'deskripsi' => 'Dokumen bidang olahraga'],
            ['nama' => 'Dokumen Kebudayaan', 'deskripsi' => 'Dokumen pelestarian kebudayaan'],
            ['nama' => 'Dokumen Sejarah', 'deskripsi' => 'Dokumen sejarah dan purbakala'],
        ];

        // Gabungkan semua data
        $semuaKategori = array_merge($kategorisDasar, $kategorisTambahan);

        $this->command->info('💾 Menyimpan data ke database...');

        // Insert data ke database
        foreach ($semuaKategori as $kategori) {
            // Cek dulu apakah sudah ada untuk menghindari duplicate
            $existing = KategoriDokumen::where('nama', $kategori['nama'])->first();
            if (!$existing) {
                KategoriDokumen::create($kategori);
            }
        }

        $totalData = KategoriDokumen::count();
        $this->command->info("✅ Kategori Dokumen berhasil di-seed! ({$totalData} data)");
        $this->command->info("📊 Data dasar: 6, Data tambahan: " . count($kategorisTambahan));
    }
}
