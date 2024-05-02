@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Buku</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('buku.create') }}" class="btn btn-primary">Buat Buku</a>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">ISBN</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Expired</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $buku)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->isbn ?? '-' }}</td>
                    <td>{{ $buku->penerbit?->penerbit }}</td>
                    <td>{{ $buku->expired }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
