@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Finishing</h2>

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
                        data-bs-target="#createFinishing">Tambah
                        finishing</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Finishing</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $finishing)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $finishing->finishing }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $finishing->toJson() }})"
                                        onkeypress="updateModalData({{ $finishing->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editFinishing">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $finishing->toJson() }})"
                                        onkeypress="updateModalData({{ $finishing->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteFinishing">
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
    <div class="modal fade" id="createFinishing" tabindex="-1" aria-labelledby="createFinishingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('finishing.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createFinishingLabel">Tambah finishing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Finishing</label><span class="text-danger">*</span>
                        <input type="text" name="finishing" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editFinishing" tabindex="-1" aria-labelledby="editFinishingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editFinishingLabel">Ubah Finishing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editFinishingNameField" class="form-label">Finishing<span class="text-danger">*</span></label>
                        <input type="text" name="finishing" class="form-control" id="editFinishingNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteFinishing" tabindex="-1" aria-labelledby="deleteFinishingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteFinishingLabel">Hapus
                        Finishing
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data finishing <strong><span id="textFinishing"></span></strong>?
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
        const editFinishingNameField = document.getElementById('editFinishingNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textFinishing = document.getElementById('textFinishing')

        function updateModalData(finishing) {
            editForm.action = `/finishing/${finishing.id}`
            editFinishingNameField.value = finishing.finishing
            deleteForm.action = `/finishing/${finishing.id}`
            textFinishing.innerText = finishing.finishing
        }
    </script>
@endsection
