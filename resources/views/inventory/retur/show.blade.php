@extends('layouts.app')

@section('content')
    <h2 class="h4">Inventory Gudang Retur</h2>
    <p>Stock log</p>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="row py-2 mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Buku</h5>
                    <span>{{ $inventory->buku->judul }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Total Stok</h5>
                    <span>{{ $inventory->stok }}</span>
                </div>
            </div>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Qty</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $transaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->description }}</td>
                    <td class="{{ $transaction->qty < 0 ? 'text-danger' : 'text-success' }}">
                        {{ $transaction->qty }}
                    </td>
                    <td>
                        {{ $transaction->created_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection
