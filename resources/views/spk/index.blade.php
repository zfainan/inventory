@extends('layouts.app')

@section('content')
    <h2 class="h4">Data SPK</h2>

    @if (auth()->user()->isPetugasGudangHasil)
        <div class="d-flex">
            <div class="ms-auto">
                <a href="{{ route('spk.create') }}" class="btn btn-primary">Input SPK</a>
            </div>
        </div>
    @endif

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card mt-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="row mb-3">
                <div class="col-6 col-xl-3 mb-3 d-flex">
                    <p class="mx-auto my-3 me-3">since</p>
                    <div>
                        <input type="date" name="since" class="form-control" value="{{ request()->input('since') }}">
                    </div>
                </div>
                <div class="col-6 col-xl-3 mb-3 d-flex">
                    <p class="mx-auto my-3 me-3">until</p>
                    <div>
                        <input type="date" name="until" class="form-control" value="{{ request()->input('until') }}">
                    </div>
                </div>
                <div class="col-12 col-xl-5 mb-3 ms-auto d-flex">
                    <div class="ms-auto">
                        <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}"
                            placeholder="Judul buku / nomor SPK...">
                    </div>
                    <button class="btn btn-primary ms-4 my-auto" type="submit">Cari</button>
                    <a href="{{ route('spk.index') }}" class="btn btn-outline-dark ms-2 my-auto">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
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

                        @if (count($data) < 1 && request()->hasAny(['since', 'until', 'keyword']))
                            <tr>
                                <td colspan="6">
                                    <p class="text-center">Data tidak ditemukan.</p>
                                </td>
                            </tr>
                        @elseif (count($data) < 1 && !request()->hasAny(['since', 'until', 'keyword']))
                            <tr>
                                <td colspan="6">
                                    <p class="text-center">Belum ada data.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $data->links() }}
@endsection
