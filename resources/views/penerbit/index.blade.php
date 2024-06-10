@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Penerbit</h2>

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
                    <a href="{{ route('buku.create') }}" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createPenerbit">Tambah Penerbit</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Penerbit</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $penerbit)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $penerbit->penerbit }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $penerbit->toJson() }})"
                                        onkeypress="updateModalData({{ $penerbit->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editPenerbit">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $penerbit->toJson() }})"
                                        onkeypress="updateModalData({{ $penerbit->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deletePenerbit">
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

    <!-- Modal Create -->
    <div class="modal fade" id="createPenerbit" tabindex="-1" aria-labelledby="createPenerbitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('penerbit.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createPenerbitLabel">Tambah Penerbit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" id="input-penerbit" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPenerbit" tabindex="-1" aria-labelledby="editPenerbitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPenerbitLabel">Ubah Penerbit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editPenerbitNameField" class="form-label">Nama Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" id="editPenerbitNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deletePenerbit" tabindex="-1" aria-labelledby="deletePenerbitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePenerbitLabel">Hapus
                        Penerbit
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data penerbit <strong><span id="textPenerbit"></span></strong>?
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
        const editPenerbitNameField = document.getElementById('editPenerbitNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textPenerbit = document.getElementById('textPenerbit')

        function updateModalData(penerbit) {
            editForm.action = `/penerbit/${penerbit.id}`
            editPenerbitNameField.value = penerbit.penerbit
            deleteForm.action = `/penerbit/${penerbit.id}`
            textPenerbit.innerText = penerbit.penerbit
        }
    </script>
@endsection
