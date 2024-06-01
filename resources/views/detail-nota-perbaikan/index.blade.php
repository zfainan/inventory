@extends('layouts.app')

@section('content')
    <h2 class="h4">Detail Nota Perbaikan</h2>

    <p class="mb-0">ID: {{ $notaPerbaikan->id }}</p>
    <p class="mb-0">Tanggal: {{ $notaPerbaikan->tanggal }}</p>
    <p class="mb-0">Petugas: {{ $notaPerbaikan->petugas->nama_petugas }}</p>

    @if (auth()->user()->isPetugasGudangRetur)
        <div class="d-flex">
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Tambah detail nota
                    perbaikan</button>
            </div>
        </div>
    @endif

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
                <th scope="col">Petugas</th>
                <th scope="col">Qty</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $detailNP)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $detailNP->petugas->nama_petugas }}</td>
                    <td>{{ $detailNP->qty }}</td>
                    <td>{{ $detailNP->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal Create data-->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('nota-perbaikan.detail.store', $notaPerbaikan) }}" method="post" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="createLabel">Tambah detail nota perbaikan</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="mb-3">
                        <label for="input-petugas" class="form-label">Petugas</label><span class="text-danger">*</span>
                        <select class="form-select" name="id_petugas" id="input-petugas" required>
                            <option selected disabled>Pilih petugas</option>
                            @foreach ($petugas as $itemPetugas)
                                <option value="{{ $itemPetugas->id }}">{{ $itemPetugas->nama_petugas }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_petugas')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="input-dr" class="form-label">Detail retur</label><span class="text-danger">*</span>
                        <select class="form-select" name="id_detail_retur" id="input-dr" required>
                            <option selected disabled>Pilih detail retur</option>
                            @foreach ($detailRetur as $itemDr)
                                <option value="{{ $itemDr->id }}">{{ $itemDr->id }} - {{ $itemDr->buku->judul }} -
                                    {{ $itemDr->qty }} pcs
                                </option>
                            @endforeach
                        </select>

                        @error('id_detail_retur')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="input-status" class="form-label">Status</label><span class="text-danger">*</span>
                        <input type="text" name="status" class="form-control" id="input-status" required>

                        @error('status')
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
