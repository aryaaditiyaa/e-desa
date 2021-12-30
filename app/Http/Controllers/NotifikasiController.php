<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function update(Request $request)
    {
        Notifikasi::whereId($request->id)->update([
            'sudah_dibaca' => 1
        ]);

        return redirect('admin/' . $request->slug);
    }
}
