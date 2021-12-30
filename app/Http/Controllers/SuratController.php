<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Surat;
use Carbon\Carbon;
use Novay\WordTemplate\WordTemplate;

class SuratController extends Controller
{
    public function print($id)
    {
        $surat = Surat::find($id);

        $template = asset('template_surat') . '/' . str_replace(" ", "%20", $surat->jenis_surat) . '.rtf';

        $array = array(
            '[nama_lengkap]' => $surat->penduduk->nama_lengkap,
            '[jenis_kelamin]' => $surat->penduduk->jenis_kelamin,
            '[tempat_lahir]' => $surat->penduduk->tempat_lahir,
            '[tanggal_lahir]' => Carbon::parse($surat->penduduk->tanggal_lahir)->isoFormat('D MMMM Y'),
            '[warga_negara]' => $surat->penduduk->status_kewarganegaraan,
            '[agama]' => $surat->penduduk->agama,
            '[status_perkawinan]' => $surat->penduduk->status_perkawinan,
            '[pekerjaan]' => $surat->penduduk->pekerjaan,
            '[alamat]' => $surat->penduduk->alamat,
            '[nik]' => $surat->penduduk->nik,
            '[tahun_ini]' => date('Y'),
            'tanggal_now' => Carbon::now()->isoFormat('D MMMM Y'),
            '[kepala_desa]' => strtoupper(Desa::find(1)->kepala_desa),
            '[surat_id]' => $surat->id,
            'golongan_darah' => $surat->penduduk->golongan_darah
        );

        $nama_file = $surat->jenis_surat . '.doc';

        return (new WordTemplate)->export($template, $array, $nama_file);
    }
}
