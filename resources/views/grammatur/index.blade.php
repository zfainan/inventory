@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Grammatur</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex">
                <div class="ms-auto">
                    <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createGrammatur">Tambah
                        grammatur</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Grammatur</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $grammatur)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grammatur->grammatur }} gr</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $grammatur->toJson() }})"
                                        onkeypress="updateModalData({{ $grammatur->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editGrammatur">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $grammatur->toJson() }})"
                                        onkeypress="updateModalData({{ $grammatur->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteGrammatur">
                                            <i class="menu-icon mdi mdi-delete-forever"></i>
                                        </span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>

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
                        <div class="input-group">
                            <input type="number" name="grammatur" class="form-control" id="input-nama" required>
                            <span class="input-group-text">Gr</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editGrammatur" tabindex="-1" aria-labelledby="editGrammaturLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editGrammaturLabel">Ubah Grammatur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editGrammaturNameField" class="form-label">Grammatur<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="grammatur" class="form-control" id="editGrammaturNameField"
                                required>
                            <span class="input-group-text">Gr</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteGrammatur" tabindex="-1" aria-labelledby="deleteGrammaturLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteGrammaturLabel">Hapus
                        Grammatur
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data grammatur <strong><span id="textGrammatur"></span></strong> gr?
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editForm = document.getElementById('editForm')
        const editGrammaturNameField = document.getElementById('editGrammaturNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textGrammatur = document.getElementById('textGrammatur')

        function updateModalData(grammatur) {
            editForm.action = `/grammatur/${grammatur.id}`
            editGrammaturNameField.value = grammatur.grammatur
            deleteForm.action = `/grammatur/${grammatur.id}`
            textGrammatur.innerText = grammatur.grammatur
        }
    </script>
@endsection
