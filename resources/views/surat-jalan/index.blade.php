@extends('layouts.app')

@section('content')
    <h2 class="h4">Surat Jalan</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary">Tambah surat jalan</a>
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
                <th scope="col">Tanggal</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $sj)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $sj->tanggal }}</td>
                    <td>
                        <a href="{{ route('surat-jalan.detail.index', $sj) }}"><span class="badge text-bg-light rounded-1"><i class="menu-icon mdi mdi-eye-outline"></i></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection
