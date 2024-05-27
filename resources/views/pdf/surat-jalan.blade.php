<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Surat Jalan</title>

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
        <h2 style="text-align: center">Surat Jalan</h2>

        <table class="table">
            <tr>
                <td>Petugas</td>
                <td>:</td>
                <td>{{ $suratJalan->petugas->nama_petugas }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $suratJalan->tanggal }}</td>
            </tr>
        </table>

        <br>

        <table class="table table-border">
            <thead>
                <tr>
                    <th>Distributor</th>
                    <th>Buku</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratJalan->detail as $detail)
                    <tr>
                        <td>{{ $detail->distributor->nama }}</td>
                        <td>{{ $detail->buku->judul }}</td>
                        <td>{{ $detail->qty }} Pcs</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="display: flex">
            <div style="width: 50%; margin: 20px 0 0 auto">
                <p style="text-align: center">Manager</p>
                <br><br><br><br>
                <p style="text-align: center">{..........................................}</p>
            </div>
        </div>
    </body>

</html>
