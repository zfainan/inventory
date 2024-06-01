@extends('layouts.app')

@section('content')
    <h2 class="h4">Surat Jalan</h2>

    @if (auth()->user()->isPetugasGudangHasil)
        <div class="d-flex">
            <div class="ms-auto">
                <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary">Tambah surat jalan</a>
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Distributor</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $sj)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sj->tanggal }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($sj->detail as $detail)
                                            <li>
                                                <strong>{{ $detail->distributor->nama }}</strong>:
                                                {{ $detail->buku->judul }} - {{ $detail->qty }} Pcs
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('surat-jalan.detail.index', $sj) }}"><span
                                            class="badge text-bg-light rounded-1"><i
                                                class="menu-icon mdi mdi-eye-outline"></i></span></a>
                                    <a target="_blank" href="{{ route('print.surat-jalan', $sj) }}"><span
                                            class="badge text-bg-light rounded-1 ms-2"><i
                                                class="menu-icon mdi mdi-printer"></i></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $data->links() }}
        </div>
    </div>

@endsection
