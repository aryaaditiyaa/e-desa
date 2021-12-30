<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Laporan Pemdes - Print</title>
</head>
<body>

<style>
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
    }
</style>

<h3 class="text-center">Laporan Pemdes #{{ $laporan_pemdes->id }}</h3>

<table class="table table-bordered my-5 report">
    <tr>
        <td>Nama Pelapor:</td>
        <td>{{ $laporan_pemdes->penduduk->nama_lengkap }}</td>
    </tr>
    <tr>
        <td>NIK:</td>
        <td>{{ $laporan_pemdes->penduduk->nik }}</td>
    </tr>
    <tr>
        <td>Nama Pelapor:</td>
        <td>{{ $laporan_pemdes->jenis_aspirasi }}</td>
    </tr>
    <tr>
        <td>Tanggal Laporan:</td>
        <td>{{ \Carbon\Carbon::parse($laporan_pemdes->created_at)->isoFormat('D MMMM YY') }}</td>
    </tr>
    <tr>
        <td>Isi:</td>
        <td>{{ $laporan_pemdes->isi }}</td>
    </tr>
    <tr>
        <td>Gambar 1:</td>
        @if(!empty($laporan_pemdes->gambar1))
            <td><img src="{{ asset('storage/' . $laporan_pemdes->gambar1) }}"
                     class="img-fluid"></td>
        @else
            <td>-</td>
        @endif
    </tr>
    <tr>
        <td>Gambar 2:</td>
        @if(!empty($laporan_pemdes->gambar2))
            <td><img src="{{ asset('storage/' . $laporan_pemdes->gambar2) }}"
                     class="img-fluid"></td>
        @else
            <td>-</td>
        @endif
    </tr>
    <tr>
        <td width="20%">Gambar 3:</td>
        @if(!empty($laporan_pemdes->gambar3))
            <td><img src="{{ asset('storage/' . $laporan_pemdes->gambar3) }}"
                     class="img-fluid"></td>
        @else
            <td>-</td>
        @endif
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
