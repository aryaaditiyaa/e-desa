<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\InfoDesa;
use App\Models\Komentar;

class InfoDesaController extends Controller
{
    public function index()
    {
        $info_desa = InfoDesa::orderBy('created_at', 'desc')->get();
        return ResponseFormatter::success([
            'info_desa' => $info_desa,
        ], 'Fetch all successful');
    }

    public function show($id)
    {
        $info_desa = InfoDesa::find($id);
        $komentar = Komentar::where('info_desa_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return ResponseFormatter::success([
            'info_desa' => $info_desa,
            'komentar' => $komentar
        ], 'Fetch by id successful');
    }
}
