@extends('layouts.app')

@section('content')
    <h2 class="h4">Detail Retur</h2>

    <p class="mb-0">Tanggal: {{ $retur->tanggal }}</p>
    <p class="mb-0">Distributor: {{ $retur->distributor->nama }}</p>
    <p class="mb-0">Petugas: {{ $retur->petugas->nama_petugas }}</p>

    <div class="d-flex">
        <div class="ms-auto">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Tambah detail retur</button>
        </div>
    </div>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Buku</th>
                <th scope="col">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $detailRetur)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $detailRetur->id }}</td>
                    <td>{{ $detailRetur->buku->judul }}</td>
                    <td>{{ $detailRetur->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal Create data-->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('retur.detail.store', $retur) }}" method="post" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="createLabel">Tambah detail retur</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="mb-3">
                        <label for="input-buku" class="form-label">Buku</label><span class="text-danger">*</span>
                        <select class="form-select" name="id_buku" id="input-buku" required>
                            <option selected disabled>Pilih buku</option>
                            @foreach ($buku as $itemBuku)
                                <option value="{{ $itemBuku->id }}">{{ $itemBuku->judul }} -
                                    {{ $itemBuku->penerbit->penerbit }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_buku')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="input-qty" class="form-label">Qty</label><span class="text-danger">*</span>
                        <input type="number" name="qty" class="form-control" id="input-qty" required>

                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
