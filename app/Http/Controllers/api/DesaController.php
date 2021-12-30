<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Desa;

class DesaController extends Controller
{
    public function show($id)
    {
        $desa = Desa::whereId($id)->first();

        return ResponseFormatter::success([
            'desa' => $desa
        ], 'Fetch successful');
    }
}
