<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Penduduk - Print</title>
</head>
<body>

<style>
    body {
        font-size: .8rem;
        overflow-x: hidden !important;
    }

    #ttd td {
        padding: 0 !important;
    }

    hr {
        border: 1.5px solid #000000 !important;
        margin-left: 1rem !important;
        margin-right: 1rem !important;
    }

    @media print {
        table.report tr {
            page-break-inside: avoid;
            page-break-after: always;
        }

        table.report td {
            page-break-inside: avoid;
            page-break-after: always;
        }

        table.report thead {
            display: table-header-group
        }

        table.report tfoot {
            display: table-footer-group
        }

        @page {
            size: landscape
        }
    }
</style>

<h5 class="text-center">SURAT KETERANGAN KARTU KELUARGA (KK)</h5>
<span class="d-block text-center"> Nomor KK: {{ $penduduk->nomor_kk }}</span>

<div class="row my-4">
    <div class="col">
        <?php
        $kepala_keluarga = \App\Models\Penduduk::where([
            ['hubungan_dalam_keluarga', 'KEPALA KELUARGA'],
            ['nomor_kk', $penduduk->nomor_kk]
        ])->first()
        ?>
        <div>
            Nama Kepala Keluarga: {{ $kepala_keluarga->nama_lengkap }}
        </div>
        <div>
            Alamat: {{ $kepala_keluarga->alamat }}
        </div>
        <div>
            RT/RW: {{ $kepala_keluarga->rt }}/{{ $kepala_keluarga->rw }}
        </div>
        <div>
            Desa/Kelurahan: Talagasari
        </div>
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
        <div>
            Kecamatan: Balaraja
        </div>
        <div>
            Kabupaten/Kota: Tangerang
        </div>
        <div>
            Kode Pos: 15610
        </div>
        <div>
            Provinsi: Banten
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <b class="text-uppercase">Daftar Anggota Keluarga</b>
    </div>
</div>

<table class="table table-bordered my-3">
    <thead>
    <tr style="background-color: #ececec">
        <th>No.</th>
        <th>Nama Lengkap</th>
        <th>NIK</th>
        <th>Jenis Kelamin</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Agama</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>Gol. Darah</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $data = \App\Models\Penduduk::where('nomor_kk', $penduduk->nomor_kk)
        ->get()
    ?>
    @foreach($data as $d)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $d->nama_lengkap }}</td>
            <td>{{ $d->nik }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->tempat_lahir }}</td>
            @if(!empty($d->tanggal_lahir))
                <td>{{ \Carbon\Carbon::parse($d->tanggal_lahir)->isoFormat('D MMMM YY') }}</td>
            @else
                <td></td>
            @endif
            <td>{{ $d->agama }}</td>
            <td>{{ $d->pendidikan_sedang_ditempuh }}</td>
            <td>{{ $d->pekerjaan }}</td>
            <td>{{ $d->golongan_darah }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table table-bordered my-4">
    <thead>
    <tr style="background-color: #ececec">
        <th>No.</th>
        <th>Status Perkawinan</th>
        <th>Tanggal Perkawinan</th>
        <th>Tanggal Perceraian</th>
        <th>Status Dalam Keluarga</th>
        <th>Kewarganegaraan</th>
        <th>No. Paspor</th>
        <th>No. Kitas</th>
        <th>Nama Ayah</th>
        <th>Nama Ibu</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $data = \App\Models\Penduduk::where('nomor_kk', $penduduk->nomor_kk)
        ->get()
    ?>
    @foreach($data as $d)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $d->status_perkawinan }}</td>
            @if(!empty($d->tanggal_perkawinan))
                <td>{{ \Carbon\Carbon::parse($d->tanggal_perkawinan)->isoFormat('D MMMM YY') }}</td>
            @else
                <td></td>
            @endif
            @if(!empty($d->tanggal_perceraian))
                <td>{{ \Carbon\Carbon::parse($d->tanggal_perceraian)->isoFormat('D MMMM YY') }}</td>
            @else
                <td></td>
            @endif
            <td>{{ $d->hubungan_dalam_keluarga }}</td>
            <td>{{ $d->status_kewarganegaraan }}</td>
            <td>{{ $d->nomor_paspor }}</td>
            <td>{{ $d->nomor_kitas }}</td>
            <td>{{ $d->nama_ayah }}</td>
            <td>{{ $d->nama_ibu }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table table-borderless my-3" id="ttd">
    <tr align="center">
        <td>Mengetahui</td>
        <td>Menyetujui</td>
        <td align="left" style="padding-left: 1rem !important">No. Registrasi: </td>
        <td>Talagasari, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YY') }}</td>
    </tr>
    <tr align="center">
        <td>Camat Ketapang</td>
        <td>Kepala Desa Talagasari</td>
        <td>Petugas Registrasi</td>
        <td>Pemohon</td>
    </tr>
    <tr align="center">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr align="center">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr align="center">
        <td>
            <hr style="margin-top: 19px">
        </td>
        <td>{{ \App\Models\Desa::find(1)->kepala_desa }}
            <hr style="margin: 0">
        </td>
        <td>
            <hr style="margin-top: 19px">
        </td>
        <td>{{ $penduduk->nama_lengkap }}
            <hr style="margin: 0">
        </td>
    </tr>
    <tr align="center">
        <td align="left" style="padding-left: 1rem !important">NIP:</td>
        <td>&nbsp;</td>
        <td align="left" style="padding-left: 1rem !important">NIP:</td>
        <td>&nbsp;</td>
    </tr>
</table>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    window.onload = function () {
        window.print();
    }
</script>
</body>
</html>
