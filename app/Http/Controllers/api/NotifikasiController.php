<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where([
            ['penduduk_id', Auth::user()->id],
            ['sudah_dibaca', '0']
        ])
            ->orWhere([
                ['sudah_dibaca', '0'],
                ['penduduk_id', null],
                ['slug', 'info-desa'],
            ])
            ->orWhere([
                ['sudah_dibaca', '0'],
                ['penduduk_id', null],
                ['slug', 'berita-desa'],
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return ResponseFormatter::success([
            'notifikasi' => $notifikasi,
        ], 'Fetch all successful');
    }

    public function update(Request $request, $id)
    {
        $data = Notifikasi::find($id);

        $data->update([
            'sudah_dibaca' => 1
        ]);

        return ResponseFormatter::success([
            'notifikasi' => $data
        ], 'Notifikasi berhasil diperbarui');
    }
}
