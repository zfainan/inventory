<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Finished Goods</title>

        <style>
            .table {
                width: 100%;
            }

            .table-border {
                border: 1px solid black;
                border-collapse: collapse;
                border-spacing: 0;
            }

            .table-border td,
            .table-border th {
                border: 1px solid black;
                margin: 0;
                padding: 8px 10px;
            }
        </style>
    </head>

    <body>
        <h2 style="text-align: center">Finished Goods</h2>

        <table class="table table-border">
            <tr>
                <td>Nomor SPK</td>
                <td>{{ $detailSpk->spk->nomor_spk }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>{{ $detailSpk->tanggal }}</td>
            </tr>
            <tr>
                <td>Judul Buku</td>
                <td>{{ $detailSpk->buku->judul }} Pcs</td>
            </tr>
            <tr>
                <td>Penerbit</td>
                <td>{{ $detailSpk->buku->penerbit->penerbit }} Pcs</td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>{{ $detailSpk->qty }} Pcs</td>
            </tr>
            <tr>
                <td>Ukuran Buku</td>
                <td>{{ $detailSpk->buku->detailMaterial->ukuranBuku->ukuran_buku }}</td>
            </tr>
            <tr>
                <td>Ukuran Kertas</td>
                <td>{{ $detailSpk->buku->detailMaterial->ukuranKertas->ukuran }}</td>
            </tr>
            <tr>
                <td>Gramasi</td>
                <td>{{ $detailSpk->buku->detailMaterial->ukuranKertas->grammatur->grammatur }} Gram</td>
            </tr>
            <tr>
                <td>Kertas Isi</td>
                <td>{{ $detailSpk->buku->detailMaterial->ukuranKertas->kertasIsi->kertas_isi }}</td>
            </tr>
            <tr>
                <td>Cetak Isi</td>
                <td>{{ $detailSpk->buku->detailMaterial->cetakIsi->cetak_isi }}</td>
            </tr>
            <tr>
                <td>Finishing</td>
                <td>{{ $detailSpk->buku->detailMaterial->finishing->finishing }}</td>
            </tr>
        </table>

        <br>

        <div style="display: flex">
            <div style="width: 50%; margin: 20px 0 0 auto">
                <p style="text-align: center">Manager</p>
                <br><br><br><br>
                <p style="text-align: center">{..........................................}</p>
            </div>
        </div>
    </body>

</html>
