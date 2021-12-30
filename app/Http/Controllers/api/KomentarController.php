<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'komentar' => 'required',
        ]);

        $data = Komentar::create([
            'slug' => $request->slug,
            'berita_desa_id' => $request->berita_desa_id,
            'info_desa_id' => $request->info_desa_id,
            'penduduk_id' => Auth::user()->id,
            'komentar' => $request->komentar
        ]);

        return ResponseFormatter::success([
            'komentar' => $data
        ], 'Komentar Berhasil ditambahkan');
    }
}
