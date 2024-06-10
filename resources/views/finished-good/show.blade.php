@extends('layouts.app')

@section('content')
    <h2 class="h4">Hasil Cetak Buku {{ $buku->judul }}</h2>

    @if (auth()->user()->isPetugasGudangHasil)
        <div class="d-flex">
            <div class="ms-auto">
                <a href="{{ route('finished-goods.create') }}" class="btn btn-primary">Tambah hasil cetak</a>
            </div>
        </div>
    @endif

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card mt-4">
        <div class="card-body">
            <form class="row">
                <div class="col-12 col-xl-6 d-flex mb-3 ms-auto">
                    <div class="col-4 ms-3 ms-auto">
                        <input type="date" name="since" class="form-control" value="{{ request()->input('since') }}">
                    </div>
                    <div class="col-1 d-flex">
                        <p class="m-auto">to</p>
                    </div>
                    <div class="col-4 ms-3">
                        <input type="date" name="until" class="form-control" value="{{ request()->input('until') }}">
                    </div>
                    <button class="btn btn-primary ms-3" type="submit">Filter</button>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No. SPK</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Qty</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $fg)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $fg->spk->nomor_spk }}</td>
                            <td>{{ $fg->tanggal }}</td>
                            <td>{{ $fg->qty }}</td>
                            <td>
                                <a href="{{ route('print.finished-goods', $fg) }}"><span
                                        class="badge text-bg-light rounded-1 ms-2"><i
                                            class="menu-icon mdi mdi-printer"></i></span></a>
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <a href="{{ route('finished-goods.edit', $fg) }}"><span
                                            class="badge text-bg-warning rounded-1 ms-2"><i
                                                class="menu-icon mdi mdi-pen"></i></span></a>
                                    {{-- <a href="#"><span class="badge text-bg-danger rounded-1 ms-2"><i
                                                class="menu-icon mdi mdi-delete-forever"></i></span></a> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>

@endsection
