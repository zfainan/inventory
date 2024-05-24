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

    <div class="card mt-4">
        <div class="card-body">
            <form class="row mb-3">
                <div class="col-6 col-xl-3 mb-3 ms-auto">
                    <input type="date" name="since" class="form-control" value="{{ request()->input('since') }}">
                </div>
                <div class="col-1 d-flex p-0">
                    <p class="mx-auto my-3">to</p>
                </div>
                <div class="col-6 col-xl-3 mb-3">
                    <input type="date" name="until" class="form-control" value="{{ request()->input('until') }}">
                </div>
                <div class="col-12 col-xl-7 mb-3 ms-auto d-flex">
                    <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}"
                        placeholder="Cari judul buku / nomor SPK...">
                    <button class="btn btn-primary ms-4" type="submit">Cari</button>
                    <a href="{{ route('spk.index') }}" class="btn btn-outline-dark ms-2">Reset</a>
                </div>
            </form>

            <table class="table">
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $spk->nomor_spk }}</td>
                            <td>{{ $spk->tanggal_masuk }}</td>
                            <td>{{ $spk->tanggal_keluar }}</td>
                            <td>{{ $spk->buku?->judul }}</td>
                            <td>{{ $spk->oplah_insheet }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $data->links() }}
@endsection
