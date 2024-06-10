@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Distributor</h2>

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
                        data-bs-target="#createDistributor">Tambah
                        distributor</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Distributor</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $distributor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $distributor->nama }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $distributor->toJson() }})"
                                        onkeypress="updateModalData({{ $distributor->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editDistributor">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $distributor->toJson() }})"
                                        onkeypress="updateModalData({{ $distributor->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteDistributor">
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
    <div class="modal fade" id="createDistributor" tabindex="-1" aria-labelledby="createDistributorLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('distributor.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createDistributorLabel">Tambah distributor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Nama distributor</label><span
                            class="text-danger">*</span>
                        <input type="text" name="nama" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editDistributor" tabindex="-1" aria-labelledby="editDistributorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDistributorLabel">Ubah Distributor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editDistributorNameField" class="form-label">Nama Distributor</label>
                        <input type="text" name="nama" class="form-control" id="editDistributorNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteDistributor" tabindex="-1" aria-labelledby="deleteDistributorLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteDistributorLabel">Hapus
                        Distributor
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data distributor <strong><span id="textDistributor"></span></strong>?
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
        const editDistributorNameField = document.getElementById('editDistributorNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textDistributor = document.getElementById('textDistributor')

        function updateModalData(distributor) {
            editForm.action = `/distributor/${distributor.id}`
            editDistributorNameField.value = distributor.nama
            deleteForm.action = `/distributor/${distributor.id}`
            textDistributor.innerText = distributor.nama
        }
    </script>
@endsection
