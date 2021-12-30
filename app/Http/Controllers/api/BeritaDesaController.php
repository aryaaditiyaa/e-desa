<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BeritaDesa;
use App\Models\Komentar;

class BeritaDesaController extends Controller
{
    public function index()
    {
        $berita_desa = BeritaDesa::orderBy('created_at', 'desc')->get();
        return ResponseFormatter::success([
            'berita_desa' => $berita_desa,
        ], 'Fetch all successful');
    }

    public function show($id)
    {
        $berita_desa = BeritaDesa::find($id);
        $komentar = Komentar::where('berita_desa_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return ResponseFormatter::success([
            'berita_desa' => $berita_desa,
            'komentar' => $komentar
        ], 'Fetch by id successful');
    }
}
