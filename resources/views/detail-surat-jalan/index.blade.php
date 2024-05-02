@extends('layouts.app')

@section('content')
    <h2 class="h4">Detail surat jalan</h2>

    <p class="mb-0">Tanggal: {{ $suratJalan->tanggal }}</p>
    <p class="mb-0">Petugas: {{ $suratJalan->petugas->nama_petugas }}</p>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('surat-jalan.detail.create', $suratJalan) }}" class="btn btn-primary">Tambah detail surat jalan</a>
        </div>
    </div>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Buku</th>
                <th scope="col">Distributor</th>
                <th scope="col">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $detailSuratJalan)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $detailSuratJalan->buku->judul }}</td>
                    <td>{{ $detailSuratJalan->distributor->nama }}</td>
                    <td>{{ $detailSuratJalan->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection
