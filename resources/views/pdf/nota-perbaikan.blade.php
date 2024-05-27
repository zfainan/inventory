<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nota Perbaikan</title>

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
        <h2 style="text-align: center">Nota Perbaikan</h2>

        <table class="table">
            <tr>
                <td>Petugas</td>
                <td>:</td>
                <td>{{ $notaPerbaikan->petugas->nama_petugas }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $notaPerbaikan->tanggal }}</td>
            </tr>
        </table>

        <br>

        <table class="table table-border">
            <thead>
                <tr>
                    <th>Petugas</th>
                    <th>Buku</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notaPerbaikan->detail as $detail)
                    <tr>
                        <td>{{ $detail->petugas->nama_petugas }}</td>
                        <td>{{ $detail->detailRetur->buku->judul }}</td>
                        <td>{{ $detail->qty }} Pcs</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <br>

        <table class="table">
            <tr>
                <td>
                    <p style="text-align: center">Petugas</p>
                    <br><br><br><br>
                    <p style="text-align: center">{{ $notaPerbaikan->petugas->nama_petugas }}</p>
                </td>
                <td>
                    <p style="text-align: center">Manager</p>
                    <br><br><br><br>
                    <p style="text-align: center">{..........................................}</p>
                </td>
            </tr>
        </table>
    </body>

</html>
