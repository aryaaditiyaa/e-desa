@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
        </h1>
        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <?php
    use App\Models\Penduduk;

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
    ?>
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link" id="pills-1-tab" data-toggle="pill" href="#pills-1"
                                   role="tab" aria-controls="pills-1" aria-selected="true">Jenis Kelamin</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2"
                                   role="tab" aria-controls="pills-2" aria-selected="false">Pendidikan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3"
                                   role="tab" aria-controls="pills-3" aria-selected="false">Pekerjaan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4"
                                   role="tab" aria-controls="pills-4" aria-selected="false">Status Perkawinan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active in" id="pills-1" role="tabpanel"
                                 aria-labelledby="pills-1-tab">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Laki-laki</td>
                                        <td>{{ $laki_laki }}</td>
                                    </tr>
                                    <tr>
                                        <td>Perempuan</td>
                                        <td>{{ $perempuan }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel"
                                 aria-labelledby="pills-2-tab">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>TIDAK / BELUM SEKOLAH</td>
                                        <td>{{ $belum_sekolah }}</td>
                                    </tr><tr>
                                        <td>BELUM TAMAT SD/SEDERAJAT</td>
                                        <td>{{ $belum_tamat_sd }}</td>
                                    </tr><tr>
                                        <td>TAMAT SD / SEDERAJAT</td>
                                        <td>{{ $tamat_sd }}</td>
                                    </tr><tr>
                                        <td>SLTP / SEDERAJAT</td>
                                        <td>{{ $sltp }}</td>
                                    </tr><tr>
                                        <td>SLTA / SEDERAJAT</td>
                                        <td>{{ $slta }}</td>
                                    </tr><tr>
                                        <td>DIPLOMA I / II</td>
                                        <td>{{ $diploma_1_2 }}</td>
                                    </tr><tr>
                                        <td>AKADEMI/ DIPLOMA III/S. MUDA</td>
                                        <td>{{ $diploma3 }}</td>
                                    </tr><tr>
                                        <td>DIPLOMA IV/ STRATA I</td>
                                        <td>{{ $strata1 }}</td>
                                    </tr><tr>
                                        <td>STRATA II</td>
                                        <td>{{ $strata2 }}</td>
                                    </tr><tr>
                                        <td>STRATA III</td>
                                        <td>{{ $strata3 }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-3" role="tabpanel"
                                 aria-labelledby="pills-3-tab">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>BELUM/TIDAK BEKERJA</td>
                                        <td>{{ $tidak_bekerja }}</td>
                                    <tr>
                                        <td>PELAJAR/MAHASISWA</td>
                                        <td>{{ $pelajar }}</td>
                                    <tr>
                                        <td>PEGAWAI NEGERI SIPIL (PNS)</td>
                                        <td>{{ $pns }}</td>
                                    <tr>
                                        <td>KARYAWAN SWASTA</td>
                                        <td>{{ $karyawan_swasta }}</td>
                                    <tr>
                                        <td>TNI/POLRI</td>
                                        <td>{{ $tni_polri }}</td>
                                    <tr>
                                        <td>DOSEN/PENGAJAR/GURU</td>
                                        <td>{{ $pengajar }}</td>
                                    <tr>
                                        <td>WIRASWASTA</td>
                                        <td>{{ $wiraswasta }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-4" role="tabpanel"
                                 aria-labelledby="pills-4-tab">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Status Perkawinan</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>BELUM KAWIN</td>
                                        <td>{{ $belum_kawin }}</td>
                                    </tr><tr>
                                        <td>KAWIN</td>
                                        <td>{{ $kawin }}</td>
                                    </tr><tr>
                                        <td>CERAI HIDUP</td>
                                        <td>{{ $cerai_hidup }}</td>
                                    </tr><tr>
                                        <td>CERAI MATI</td>
                                        <td>{{ $cerai_mati }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


