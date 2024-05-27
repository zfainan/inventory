@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Retur</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('buku.create') }}" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#createRetur">Tambah Retur</a>
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
                <th scope="col">Tanggal</th>
                <th scope="col">Distributor</th>
                <th scope="col">Petugas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $retur)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $retur->tanggal }}</td>
                    <td>{{ $retur->distributor->nama }}</td>
                    <td>{{ $retur->petugas->nama_petugas }}</td>
                    <td>
                        <a href="{{ route('retur.detail.index', $retur) }}"><span class="badge text-bg-light rounded-1"><i
                                    class="menu-icon mdi mdi-eye-outline"></i></span></a>
                        <a target="_blank" href="{{ route('print.retur', $retur) }}"><span class="badge text-bg-light rounded-1 ms-2"><i
                                    class="menu-icon mdi mdi-printer"></i></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal -->
    <div class="modal fade" id="createRetur" tabindex="-1" aria-labelledby="createReturLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('retur.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createReturLabel">Tambah Retur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-distributor" class="form-label">Distributor</label><span
                            class="text-danger">*</span>
                        <select class="form-select" name="id_distributor" id="input-distributor" required>
                            <option selected disabled>Pilih distributor</option>
                            @foreach ($distributor as $itemDistributor)
                                <option value="{{ $itemDistributor->id }}">{{ $itemDistributor->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_distributor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

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
                        <label for="input-tanggal" class="form-label">Tanggal</label><span class="text-danger">*</span>
                        <input type="date" name="tanggal" class="form-control" id="input-tanggal" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
