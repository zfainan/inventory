@extends('layouts.app')

@section('content')
    <h2 class="h4">Inventory Gudang Retur</h2>
    <h3>{{ $inventory->buku->judul }} - {{ $inventory->buku->penerbit->penerbit }}</h3>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="row mt-4">
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Total Stok</h5>
                    <span>{{ $inventory->stok }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Ukuran Buku</h5>
                    <span>{{ $inventory->buku?->detailMaterial?->ukuranBuku?->ukuran_buku }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Grammatur</h5>
                    <span>{{ $inventory->buku?->detailMaterial?->ukuranKertas?->grammatur?->grammatur }} gr</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Kertas Isi</h5>
                    <span>{{ $inventory->buku?->detailMaterial?->ukuranKertas?->kertasIsi?->kertas_isi }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Cetak Isi</h5>
                    <span>{{ $inventory->buku?->detailMaterial?->cetakIsi?->cetak_isi }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 px-2">
            <div class="card">
                <div class="card-body">
                    <h5>Finishing</h5>
                    <span>{{ $inventory->buku?->detailMaterial?->finishing?->finishing }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex">
                <h4 class="my-auto">Riwayat Perubahan Stok</h4>
                <div class="ms-auto">
                    <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Pengurangan
                        stok</a>
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('inventory-retur.stock-decrease.store') }}" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLabel">Pengurangan stok</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Kurangi stok buku {{ $inventory->buku->judul }}

                    @csrf
                    <input type="hidden" name="id_inventory" value="{{ $inventory->id }}">

                    <div class="">
                        <div class="my-3">
                            <label for="qty" class="form-label">Jumlah</label>
                            <input type="number" name="qty" class="form-control" id="qty">
                        </div>
                        <div class="my-3">
                            <label for="deskripsi" class="form-label">Deskripsi/Alasan pengurangan</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kurangi stok</button>
                </div>
            </form>
        </div>
    </div>
@endsection
