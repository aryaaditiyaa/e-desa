<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Data Penduduk - Print</title>
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

<h5 class="text-center">Data Penduduk</h5>

<table class="table table-bordered my-5">
    <thead>
    <tr style="background-color: #ececec">
        <th>No</th>
        <th>No. KK</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Alamat</th>
        <th>RW</th>
        <th>RT</th>
        <th>Jenis Kelamin</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Agama</th>
        <th>Pendidikan (dlm KK)</th>
        <th>Pekerjaan</th>
        <th>Kawin</th>
        <th>Hub. Keluarga</th>
        <th>Nama Ayah</th>
        <th>Nama Ibu</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penduduk as $p)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $p->nomor_kk }}</td>
            <td>{{ $p->nama_lengkap }}</td>
            <td>{{ $p->nik }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->rt }}</td>
            <td>{{ $p->rw }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->tempat_lahir }}</td>
            @if(!empty($p->tanggal_lahir))
                <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->isoFormat('D MMMM YY') }}</td>
            @else
                <td></td>
            @endif
            <td>{{ $p->agama }}</td>
            <td>{{ $p->pendidikan_dalam_kk }}</td>
            <td>{{ $p->pekerjaan }}</td>
            <td>{{ $p->status_perkawinan }}</td>
            <td>{{ $p->hubungan_dalam_keluarga }}</td>
            <td>{{ $p->nama_ayah }}</td>
            <td>{{ $p->nama_ibu }}</td>
            <td>{{ $p->status_penduduk }}</td>
        </tr>
    @endforeach
    </tbody>
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
