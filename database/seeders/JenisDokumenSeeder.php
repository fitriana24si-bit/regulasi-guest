<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JenisDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $this->command->info('🔄 Membuat data dummy jenis dokumen...');

        // Data dasar yang sudah ada (tetap dipertahankan)
        $jenisDasar = [
            [
                'nama_jenis' => 'Perdes',
                'deskripsi' => 'Peraturan Desa'
            ],
            [
                'nama_jenis' => 'Perkades',
                'deskripsi' => 'Peraturan Kepala Desa'
            ],
            [
                'nama_jenis' => 'SE',
                'deskripsi' => 'Surat Edaran'
            ],
            [
                'nama_jenis' => 'SK',
                'deskripsi' => 'Surat Keputusan'
            ],
            [
                'nama_jenis' => 'Nota',
                'deskripsi' => 'Nota Dinas'
            ]
        ];

        // Data tambahan untuk mencapai 100
        $jenisTambahan = [
            // Peraturan
            ['nama_jenis' => 'Perda', 'deskripsi' => 'Peraturan Daerah'],
            ['nama_jenis' => 'Perbup', 'deskripsi' => 'Peraturan Bupati'],
            ['nama_jenis' => 'Pergub', 'deskripsi' => 'Peraturan Gubernur'],
            ['nama_jenis' => 'Permen', 'deskripsi' => 'Peraturan Menteri'],
            ['nama_jenis' => 'Perpres', 'deskripsi' => 'Peraturan Presiden'],
            ['nama_jenis' => 'PP', 'deskripsi' => 'Peraturan Pemerintah'],
            ['nama_jenis' => 'UU', 'deskripsi' => 'Undang-Undang'],

            // Surat
            ['nama_jenis' => 'SP', 'deskripsi' => 'Surat Perintah'],
            ['nama_jenis' => 'ST', 'deskripsi' => 'Surat Tugas'],
            ['nama_jenis' => 'S.Ket', 'deskripsi' => 'Surat Keterangan'],
            ['nama_jenis' => 'SPeng', 'deskripsi' => 'Surat Pengantar'],
            ['nama_jenis' => 'SUnd', 'deskripsi' => 'Surat Undangan'],
            ['nama_jenis' => 'SPember', 'deskripsi' => 'Surat Pemberitahuan'],
            ['nama_jenis' => 'SPerny', 'deskripsi' => 'Surat Pernyataan'],
            ['nama_jenis' => 'SKuasa', 'deskripsi' => 'Surat Kuasa'],
            ['nama_jenis' => 'SMandat', 'deskripsi' => 'Surat Mandat'],
            ['nama_jenis' => 'SIzin', 'deskripsi' => 'Surat Izin'],

            // Laporan
            ['nama_jenis' => 'Lapkeu', 'deskripsi' => 'Laporan Keuangan'],
            ['nama_jenis' => 'Lapkeg', 'deskripsi' => 'Laporan Kegiatan'],
            ['nama_jenis' => 'Laptah', 'deskripsi' => 'Laporan Tahunan'],
            ['nama_jenis' => 'Lapbul', 'deskripsi' => 'Laporan Bulanan'],
            ['nama_jenis' => 'Laptri', 'deskripsi' => 'Laporan Triwulan'],
            ['nama_jenis' => 'Lapsem', 'deskripsi' => 'Laporan Semester'],
            ['nama_jenis' => 'Lapakhir', 'deskripsi' => 'Laporan Akhir'],
            ['nama_jenis' => 'Lapprog', 'deskripsi' => 'Laporan Progress'],
            ['nama_jenis' => 'Lapeval', 'deskripsi' => 'Laporan Evaluasi'],

            // Dokumen Administrasi
            ['nama_jenis' => 'BA', 'deskripsi' => 'Berita Acara'],
            ['nama_jenis' => 'Notulen', 'deskripsi' => 'Notulen Rapat'],
            ['nama_jenis' => 'DaftarHadir', 'deskripsi' => 'Daftar Hadir'],
            ['nama_jenis' => 'Proposal', 'deskripsi' => 'Proposal Kegiatan'],
            ['nama_jenis' => 'MoU', 'deskripsi' => 'Memorandum of Understanding'],
            ['nama_jenis' => 'PKS', 'deskripsi' => 'Perjanjian Kerjasama'],
            ['nama_jenis' => 'Kontrak', 'deskripsi' => 'Kontrak Kerja'],
            ['nama_jenis' => 'SPK', 'deskripsi' => 'Surat Perintah Kerja'],
            ['nama_jenis' => 'Kwitansi', 'deskripsi' => 'Kwitansi Pembayaran'],

            // Dokumen Teknis
            ['nama_jenis' => 'Studkel', 'deskripsi' => 'Studi Kelayakan'],
            ['nama_jenis' => 'Amdal', 'deskripsi' => 'Analisis Mengenai Dampak Lingkungan'],
            ['nama_jenis' => 'Renja', 'deskripsi' => 'Rencana Kerja'],
            ['nama_jenis' => 'RAB', 'deskripsi' => 'Rencana Anggaran Biaya'],
            ['nama_jenis' => 'TOR', 'deskripsi' => 'Terms of Reference'],
            ['nama_jenis' => 'SOW', 'deskripsi' => 'Scope of Work'],

            // Dokumen Legal
            ['nama_jenis' => 'Akta', 'deskripsi' => 'Akta Notaris'],
            ['nama_jenis' => 'Sertifikat', 'deskripsi' => 'Sertifikat Kepemilikan'],
            ['nama_jenis' => 'IMB', 'deskripsi' => 'Izin Mendirikan Bangunan'],
            ['nama_jenis' => 'SIUP', 'deskripsi' => 'Surat Izin Usaha Perdagangan'],
            ['nama_jenis' => 'TDP', 'deskripsi' => 'Tanda Daftar Perusahaan'],
            ['nama_jenis' => 'NPWP', 'deskripsi' => 'Nomor Pokok Wajib Pajak'],

            // Dokumen Perencanaan
            ['nama_jenis' => 'Renstra', 'deskripsi' => 'Rencana Strategis'],
            ['nama_jenis' => 'RKP', 'deskripsi' => 'Rencana Kerja Pemerintah'],
            ['nama_jenis' => 'RTRW', 'deskripsi' => 'Rencana Tata Ruang Wilayah'],
            ['nama_jenis' => 'RDTR', 'deskripsi' => 'Rencana Detail Tata Ruang'],
            ['nama_jenis' => 'MasterPlan', 'deskripsi' => 'Master Plan Pengembangan'],

            // Dokumen Pengadaan
            ['nama_jenis' => 'RUP', 'deskripsi' => 'Rencana Umum Pengadaan'],
            ['nama_jenis' => 'DokPen', 'deskripsi' => 'Dokumen Penawaran'],
            ['nama_jenis' => 'BAHP', 'deskripsi' => 'Berita Acara Hasil Pengadaan'],

            // Tambahan lainnya
            ['nama_jenis' => 'Pengumuman', 'deskripsi' => 'Pengumuman Resmi'],
            ['nama_jenis' => 'Brosur', 'deskripsi' => 'Brosur Informasi'],
            ['nama_jenis' => 'Leaflet', 'deskripsi' => 'Leaflet Promosi'],
            ['nama_jenis' => 'Panduan', 'deskripsi' => 'Buku Panduan'],
            ['nama_jenis' => 'Manual', 'deskripsi' => 'Manual Prosedur'],
            ['nama_jenis' => 'Standar', 'deskripsi' => 'Standar Operasional'],
            ['nama_jenis' => 'Pedoman', 'deskripsi' => 'Pedoman Pelaksanaan'],
            ['nama_jenis' => 'Formulir', 'deskripsi' => 'Formulir Isian'],
            ['nama_jenis' => 'Template', 'deskripsi' => 'Template Dokumen'],
            ['nama_jenis' => 'Format', 'deskripsi' => 'Format Standar'],
            ['nama_jenis' => 'Struktur', 'deskripsi' => 'Struktur Organisasi'],
            ['nama_jenis' => 'Profil', 'deskripsi' => 'Profil Instansi'],
            ['nama_jenis' => 'VisiMisi', 'deskripsi' => 'Visi dan Misi'],
            ['nama_jenis' => 'Tupoksi', 'deskripsi' => 'Tugas Pokok dan Fungsi'],
            ['nama_jenis' => 'SOP', 'deskripsi' => 'Standard Operating Procedure'],
            ['nama_jenis' => 'IK', 'deskripsi' => 'Instruksi Kerja'],
            ['nama_jenis' => 'Juknis', 'deskripsi' => 'Petunjuk Teknis'],
            ['nama_jenis' => 'Juklak', 'deskripsi' => 'Petunjuk Pelaksanaan'],
            ['nama_jenis' => 'KAK', 'deskripsi' => 'Kerangka Acuan Kerja'],
            ['nama_jenis' => 'HPS', 'deskripsi' => 'Harga Perkiraan Sendiri'],
            ['nama_jenis' => 'RKS', 'deskripsi' => 'Rencana Kerja dan Syarat'],
            ['nama_jenis' => 'Gambar', 'deskripsi' => 'Gambar Teknik'],
            ['nama_jenis' => 'Denah', 'deskripsi' => 'Denah Lokasi'],
            ['nama_jenis' => 'Peta', 'deskripsi' => 'Peta Wilayah'],
            ['nama_jenis' => 'Grafik', 'deskripsi' => 'Grafik Data'],
            ['nama_jenis' => 'Tabel', 'deskripsi' => 'Tabel Informasi'],
            ['nama_jenis' => 'Chart', 'deskripsi' => 'Chart Presentasi'],
            ['nama_jenis' => 'Diagram', 'deskripsi' => 'Diagram Alir'],
            ['nama_jenis' => 'Matriks', 'deskripsi' => 'Matriks Analisis'],
            ['nama_jenis' => 'Kuesioner', 'deskripsi' => 'Kuesioner Survey'],
            ['nama_jenis' => 'Lembar', 'deskripsi' => 'Lembar Kerja'],
            ['nama_jenis' => 'Checklist', 'deskripsi' => 'Checklist Verifikasi'],
            ['nama_jenis' => 'FormA', 'deskripsi' => 'Formulir A - Pendaftaran'],
            ['nama_jenis' => 'FormB', 'deskripsi' => 'Formulir B - Permohonan'],
            ['nama_jenis' => 'FormC', 'deskripsi' => 'Formulir C - Laporan'],
            ['nama_jenis' => 'FormD', 'deskripsi' => 'Formulir D - Evaluasi'],
            ['nama_jenis' => 'Draft', 'deskripsi' => 'Draft Dokumen'],
            ['nama_jenis' => 'Revisi', 'deskripsi' => 'Dokumen Revisi'],
            ['nama_jenis' => 'Final', 'deskripsi' => 'Dokumen Final'],
            ['nama_jenis' => 'Arsip', 'deskripsi' => 'Dokumen Arsip'],
        ];

        // Gabungkan semua data
        $semuaJenis = array_merge($jenisDasar, $jenisTambahan);

        $this->command->info('💾 Menyimpan data ke database...');

        // Insert data ke database
        foreach ($semuaJenis as $data) {
            // Cek dulu apakah sudah ada untuk menghindari duplicate
            $existing = JenisDokumen::where('nama_jenis', $data['nama_jenis'])->first();
            if (!$existing) {
                JenisDokumen::create($data);
            }
        }

        $totalData = JenisDokumen::count();
        $this->command->info("✅ Jenis Dokumen berhasil di-seed! ({$totalData} data)");
        $this->command->info("📊 Data dasar: 5, Data tambahan: " . count($jenisTambahan));
    }
}
