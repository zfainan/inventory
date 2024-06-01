@extends('layouts.app')

@section('content')
    <h2 class="h4">Hasil Cetak</h2>

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
                <div class="col-12 col-xl-6 mb-3 ms-auto d-flex">
                    <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}"
                        placeholder="Cari judul buku...">
                    <button class="btn btn-primary ms-4" type="submit">Cari</button>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penerbit->penerbit }}</td>
                            <td>
                                <a href="{{ route('finished-goods.show', $buku) }}"><span
                                        class="badge text-bg-light rounded-1"><i
                                            class="menu-icon mdi mdi-eye-outline"></i></span></a>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($data) < 1 && request()->has('keyword'))
                        <tr>
                            <td colspan="3">
                                <p class="text-center">Buku tidak ditemukan.</p>
                            </td>
                        </tr>
                    @endif

                    @if (count($data) < 1 && !request()->has('keyword'))
                        <tr>
                            <td colspan="3">
                                <p class="text-center">Belum ada hasil cetak</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{ $data->links() }}
@endsection
