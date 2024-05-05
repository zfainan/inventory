@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Grammatur</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGrammatur">Tambah
                grammatur</a>
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
                <th scope="col">Grammatur</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $grammatur)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $grammatur->grammatur }} gr</td>
                    <td>
                        <button class="badge rounded border-0" title="delete" data-bs-toggle="modal"
                            data-bs-target="#deleteGrammatur{{ $grammatur->id }}">
                            <i class="text-danger h4 mdi mdi-delete menu-icon"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus Grammatur -->
                <div class="modal fade" id="deleteGrammatur{{ $grammatur->id }}" tabindex="-1"
                    aria-labelledby="deleteGrammatur{{ $grammatur->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteGrammatur{{ $grammatur->id }}Label">Hapus Grammatur
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin akan menghapus {{ $grammatur->grammatur }} gram?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('grammatur.destroy', $grammatur) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal Create Data -->
    <div class="modal fade" id="createGrammatur" tabindex="-1" aria-labelledby="createGrammaturLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('grammatur.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createGrammaturLabel">Tambah grammatur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Grammatur</label><span class="text-danger">*</span>
                        <input type="number" name="grammatur" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
