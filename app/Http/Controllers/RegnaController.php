<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegnaController extends Controller
{
    public function dashboard() {
        return view('pages.dashboard');
    }

    public function jenis() {
        return view('pages.jenis');
    }

    public function kategori() {
        return view('pages.kategori');
    }

    public function dokumen() {
        return view('pages.dokumen');
    }

    public function riwayat() {
        return view('pages.riwayat');
    }

    public function lampiran() {
        return view('pages.lampiran');
    }
    public function login() {
        return view('pages');
    }
}
