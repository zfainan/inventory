@extends('layouts.app')

@section('content')
    <h2 class="h4">Inventory Gudang Hasil</h2>
    <p>Stock log: {{ $inventory->buku?->judul }}</p>

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
