<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Retur</title>

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

            .company-details {
                margin: auto;
            }

            .company-details h1 {
                margin: 0;
                font-size: 24px;
                text-align: center;
            }

            .company-details p {
                margin: 5px 0;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <table style="width: 100%">
            <tr>
                <td>
                    <img src="{{ public_path('img/logo.png') }}" alt="Logo CV. Galaxy Media Ilmu" width="90">
                </td>
                <td class="company-details">
                    <h1>CV. Galaxy Media Ilmu</h1>
                    <p>Tlogo, RT.2/RW.2, Ambarketawang, Kec. Gamping, Kabupaten Sleman</p>
                    {{-- <p>Telepon: (021) 123-4567 | Email: info@galaxymediailmu.com</p> --}}
                    <p>Website: inventory.celyverse.com</p>
                </td>
            </tr>
        </table>

        <hr>

        <h3>Penerimaan Barang Retur</h3>

        <table class="table">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $retur->tanggal }}</td>
            </tr>
            <tr>
                <td>Distributor</td>
                <td>:</td>
                <td>{{ $retur->distributor->nama }}</td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td>:</td>
                <td>{{ $retur->petugas->nama_petugas }}</td>
            </tr>
        </table>

        <br>

        <p>Dengan hormat,</p>
        <p>Kami telah menerima barang retur dengan rincian sebagai berikut:</p>

        <table class="table-border table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($retur->detail as $detail)
                    <tr>
                        <td>{{ $detail->buku->judul }}</td>
                        <td>{{ $detail->qty }} Pcs</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <p>Terima kasih atas kerjasama Anda.</p>
        <br>

        <p>Hormat kami,</p>

        <br>

        <table class="table">
            <tr>
                <td>
                    <p style="text-align: center">Petugas</p>
                    <br><br><br><br>
                    <p style="text-align: center">{{ $retur->petugas->nama_petugas }}</p>
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
