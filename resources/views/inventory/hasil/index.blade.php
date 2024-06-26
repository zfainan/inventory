@extends('layouts.app')

@section('content')
    <h2 class="h4">Inventory Gudang Hasil</h2>

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
                    <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}"
                        placeholder="Cari judul buku...">
                    <button class="btn btn-primary ms-4" type="submit">Cari</button>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $inventory)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $inventory->buku->judul }}</td>
                            <td>{{ $inventory->stok }}</td>
                            <td>
                                <a href="{{ route('inventory-hasil.show', $inventory) }}"><span
                                        class="badge text-bg-light rounded-1"><i
                                            class="menu-icon mdi mdi-eye-outline"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>
@endsection
