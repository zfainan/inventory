@extends('layouts.app')

@section('content')
    <h2 class="h4">Data SPK</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('spk.create') }}" class="btn btn-primary">Input SPK</a>
        </div>
    </div>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor SPK</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Buku</th>
                <th scope="col">Jumlah Cetak (Oplah Dasar + insheet)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $spk)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $spk->nomor_spk }}</td>
                    <td>{{ $spk->tanggal_masuk }}</td>
                    <td>{{ $spk->tanggal_keluar }}</td>
                    <td>{{ $spk->buku?->judul }}</td>
                    <td>{{ $spk->oplah_insheet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection
