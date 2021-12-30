<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;

class StatistikController extends Controller
{
    public function index()
    {
        $laki_laki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        $belum_sekolah = Penduduk::where('pendidikan_sedang_ditempuh', 'TIDAK / BELUM SEKOLAH')->count();
        $belum_tamat_sd = Penduduk::where('pendidikan_sedang_ditempuh', 'BELUM TAMAT SD/SEDERAJAT')->count();
        $tamat_sd = Penduduk::where('pendidikan_sedang_ditempuh', 'TAMAT SD / SEDERAJAT')->count();
        $sltp = Penduduk::where('pendidikan_sedang_ditempuh', 'SLTP / SEDERAJAT')->count();
        $slta = Penduduk::where('pendidikan_sedang_ditempuh', 'SLTA / SEDERAJAT')->count();
        $diploma_1_2 = Penduduk::where('pendidikan_sedang_ditempuh', 'DIPLOMA I / II')->count();
        $diploma3 = Penduduk::where('pendidikan_sedang_ditempuh', 'AKADEMI/ DIPLOMA III/S. MUDA')->count();
        $strata1 = Penduduk::where('pendidikan_sedang_ditempuh', 'DIPLOMA IV/ STRATA I')->count();
        $strata2 = Penduduk::where('pendidikan_sedang_ditempuh', 'STRATA II')->count();
        $strata3 = Penduduk::where('pendidikan_sedang_ditempuh', 'STRATA III')->count();

        $tidak_bekerja = Penduduk::where('pekerjaan', 'BELUM/TIDAK BEKERJA')->count();
        $pelajar = Penduduk::where('pekerjaan', 'PELAJAR/MAHASISWA')->count();
        $pns = Penduduk::where('pekerjaan', 'PEGAWAI NEGERI SIPIL (PNS)')->count();
        $karyawan_swasta = Penduduk::where('pekerjaan', 'KARYAWAN SWASTA')->count();
        $tni_polri = Penduduk::where('pekerjaan', 'TNI/POLRI')->count();
        $pengajar = Penduduk::where('pekerjaan', 'DOSEN/PENGAJAR/GURU')->count();
        $wiraswasta = Penduduk::where('pekerjaan', 'WIRASWASTA')->count();

        $belum_kawin = Penduduk::where('status_perkawinan', 'BELUM KAWIN')->count();
        $kawin = Penduduk::where('status_perkawinan', 'KAWIN')->count();
        $cerai_hidup = Penduduk::where('status_perkawinan', 'CERAI HIDUP')->count();
        $cerai_mati = Penduduk::where('status_perkawinan', 'CERAI MATI')->count();

        return ResponseFormatter::success([
            'jenis_kelamin' => ([
                'Laki-laki' => $laki_laki,
                'Perempuan' => $perempuan
            ]),
            'pendidikan' => ([
                'TIDAK / BELUM SEKOLAH' => $belum_sekolah,
                'BELUM TAMAT SD/SEDERAJAT' => $belum_tamat_sd,
                'TAMAT SD / SEDERAJAT' => $tamat_sd,
                'SLTP / SEDERAJAT' => $sltp,
                'SLTA / SEDERAJAT' => $slta,
                'DIPLOMA I / II' => $diploma_1_2,
                'AKADEMI/ DIPLOMA III/S. MUDA' => $diploma3,
                'DIPLOMA IV/ STRATA I' => $strata1,
                'STRATA II' => $strata2,
                'STRATA III' => $strata3,
            ]),
            'pekerjaan' => ([
                'BELUM/TIDAK BEKERJA' => $tidak_bekerja,
                'PELAJAR/MAHASISWA' => $pelajar,
                'PEGAWAI NEGERI SIPIL (PNS)' => $pns,
                'KARYAWAN SWASTA' => $karyawan_swasta,
                'TNI/POLRI' => $tni_polri,
                'DOSEN/PENGAJAR/GURU' => $pengajar,
                'WIRASWASTA' => $wiraswasta,
            ]),
            'status_kawin' => ([
                'BELUM KAWIN' => $belum_kawin,
                'KAWIN' => $kawin,
                'CERAI HIDUP' => $cerai_hidup,
                'CERAI MATI' => $cerai_mati
            ])
        ], 'Fetch All Successful');
    }
}
