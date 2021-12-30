<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;

class PendudukController extends Controller
{
    public function print($id)
    {
        $penduduk = Penduduk::find($id);

        return view('vendor.voyager.penduduk.print', compact('penduduk'));
    }

    public function printAll()
    {
        $penduduk = Penduduk::all();

        return view('vendor.voyager.penduduk.print-all', compact('penduduk'));
    }
}
