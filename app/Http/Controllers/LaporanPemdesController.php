<?php

namespace App\Http\Controllers;

use App\Models\LaporanPemdes;

class LaporanPemdesController extends Controller
{
    public function print($id)
    {
        $laporan_pemdes = LaporanPemdes::find($id);

        return view('vendor.voyager.laporan-pemdes.print', compact('laporan_pemdes'));
    }
}
