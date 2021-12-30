<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\LaporanPemdes;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanPemdesController extends Controller
{
    public function index()
    {
        $laporan_pemdes = LaporanPemdes::where('penduduk_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')->get();
        return ResponseFormatter::success([
            'laporan_pemdes' => $laporan_pemdes,
        ], 'Fetch all successful');
    }

    public function show($id)
    {
        $laporan_pemdes = LaporanPemdes::find($id);
        return ResponseFormatter::success([
            'laporan_pemdes' => $laporan_pemdes,
        ], 'Fetch by id successful');
    }

    public function store(Request $request)
    {
        if ($request->file('gambar1')) {
            $path_gambar_1 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar1')
            );
        }

        if ($request->file('gambar2')) {
            $path_gambar_2 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar2')
            );
        }

        if ($request->file('gambar3')) {
            $path_gambar_3 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar3')
            );
        }

        $laporan_pemdes = LaporanPemdes::create([
            'penduduk_id' => Auth::user()->id,
            'jenis_aspirasi' => $request->jenis_aspirasi,
            'isi' => $request->isi,
            'gambar1' => $request->file('gambar1') ? substr($path_gambar_1, 7) : null,
            'gambar2' => $request->file('gambar2') ? substr($path_gambar_2, 7) : null,
            'gambar3' => $request->file('gambar3') ? substr($path_gambar_3, 7) : null
        ]);

        Notifikasi::create([
            'sudah_dibaca' => 0,
            'slug' => 'laporan-pemdes',
            'isi' => 'Anda memiliki laporan pemdes baru dari penduduk'
        ]);

        return ResponseFormatter::success([
            'laporan_pemdes' => $laporan_pemdes,
        ], 'Laporan pemdes berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        if ($request->file('gambar1')) {
            $path_gambar_1 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar1')
            );
        }

        if ($request->file('gambar2')) {
            $path_gambar_2 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar2')
            );
        }

        if ($request->file('gambar3')) {
            $path_gambar_3 = Storage::putFile(
                'public/laporan-pemdes/' . date('FY'),
                $request->file('gambar3')
            );
        }

        $data = LaporanPemdes::find($id);

        $data->update([
            'jenis_aspirasi' => $request->jenis_aspirasi,
            'isi' => $request->isi,
            'gambar1' => $request->file('gambar1') ? substr($path_gambar_1, 7) : $data->gambar1,
            'gambar2' => $request->file('gambar2') ? substr($path_gambar_2, 7) : $data->gambar2,
            'gambar3' => $request->file('gambar3') ? substr($path_gambar_3, 7) : $data->gambar3
        ]);

        return ResponseFormatter::success([
            'laporan_pemdes' => $data,
        ], 'Laporan pemdes berhasil diperbarui');
    }
}
