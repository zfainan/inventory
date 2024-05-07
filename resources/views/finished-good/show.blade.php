@extends('layouts.app')

@section('content')
    <h2 class="h4">Hasil Cetak Buku {{ $buku->judul }}</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('finished-goods.create') }}" class="btn btn-primary">Tambah hasil cetak</a>
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
                <th scope="col">No. SPK</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $fg)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $fg->spk->nomor_spk }}</td>
                    <td>{{ $fg->tanggal }}</td>
                    <td>{{ $fg->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection