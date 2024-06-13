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

        <h3>Nota Perbaikan</h3>

        <table class="table">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $notaPerbaikan->tanggal }}</td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td>:</td>
                <td>{{ $notaPerbaikan->petugas->nama_petugas }}</td>
            </tr>
        </table>

        <br>

        <p>Dengan hormat,</p>
        <p>Berikut ini adalah rincian perbaikan yang telah kami lakukan:</p>

        <table class="table-border table">
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

        <p>Hormat kami,</p>

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
