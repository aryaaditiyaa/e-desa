<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::where('penduduk_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return ResponseFormatter::success([
            'surat' => $surat
        ], 'Fetch all successful');
    }

    public function show($id)
    {
        $surat = Surat::find($id);
        return ResponseFormatter::success([
            'surat' => $surat
        ], 'Fetch by id successful');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokumen' => 'mimes:pdf,doc,docx,rtf'
        ]);

        if ($request->file('dokumen')) {
            $path_dokumen = Storage::putFile(
                'public/surat/' . date('FY'),
                $request->file('dokumen')
            );

            $dokumen = array([
                'download_link' => substr($path_dokumen, 7),
                'original_name' => $request->file('dokumen')->getClientOriginalName()
            ]);
        }

        $data = Surat::create([
            'penduduk_id' => Auth::user()->id,
            'status' => 'Belum Diproses',
            'jenis_surat' => $request->jenis_surat,
            'dokumen' => $request->file('dokumen') ? json_encode($dokumen) : null
        ]);

        Notifikasi::create([
            'sudah_dibaca' => 0,
            'slug' => 'surat',
            'isi' => 'Anda memiliki surat baru dari penduduk'
        ]);

        return ResponseFormatter::success([
            'surat' => $data,
        ], 'Surat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokumen' => 'mimes:pdf,doc,docx,rtf'
        ]);

        if ($request->file('dokumen')) {
            $path_dokumen = Storage::putFile(
                'public/surat/' . date('FY'),
                $request->file('dokumen')
            );

            $dokumen = array([
                'download_link' => substr($path_dokumen, 7),
                'original_name' => $request->file('dokumen')->getClientOriginalName()
            ]);
        }

        $data = Surat::find($id);

        $data->update([
            'penduduk_id' => Auth::user()->id,
            'jenis_surat' => $request->jenis_surat,
            'dokumen' => $request->file('dokumen') ? json_encode($dokumen) : $data->dokumen
        ]);

        return ResponseFormatter::success([
            'surat' => $data,
        ], 'Surat berhasil diperarui');
    }
}
