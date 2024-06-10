@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Cetak Isi</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCetakIsi">Tambah
                cetak isi</a>
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
                <th scope="col">Cetak isi</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $cetakIsi)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $cetakIsi->cetak_isi }}</td>
                    <td class="text-center">
                        @if (auth()->user()->isPetugasGudangHasil)
                            <button onclick="updateModalData({{ $cetakIsi->toJson() }})"
                                onkeypress="updateModalData({{ $cetakIsi->toJson() }})"
                                class="m-0 ms-2 border-0 p-0">
                                <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                    data-bs-target="#editCetakIsi">
                                    <i class="menu-icon mdi mdi-pen"></i>
                                </span>
                            </button>
                            <button onclick="updateModalData({{ $cetakIsi->toJson() }})"
                                onkeypress="updateModalData({{ $cetakIsi->toJson() }})"
                                class="m-0 ms-2 border-0 p-0">
                                <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteCetakIsi">
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

    <!-- Modal Create Data -->
    <div class="modal fade" id="createCetakIsi" tabindex="-1" aria-labelledby="createCetakIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('cetak-isi.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createCetakIsiLabel">Tambah cetak isi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Cetak isi</label><span class="text-danger">*</span>
                        <input type="text" name="cetak_isi" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editCetakIsi" tabindex="-1" aria-labelledby="editCetakIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCetakIsiLabel">Ubah Cetak Isi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editCetakIsiNameField" class="form-label">Cetak Isi</label>
                        <input type="text" name="cetak_isi" class="form-control" id="editCetakIsiNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteCetakIsi" tabindex="-1" aria-labelledby="deleteCetakIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCetakIsiLabel">Hapus
                        Cetak Isi
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data cetak isi <strong><span id="textCetakIsi"></span></strong>?
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
        const editCetakIsiNameField = document.getElementById('editCetakIsiNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textCetakIsi = document.getElementById('textCetakIsi')

        function updateModalData(cetakIsi) {
            editForm.action = `/cetak-isi/${cetakIsi.id}`
            editCetakIsiNameField.value = cetakIsi.cetak_isi
            deleteForm.action = `/cetak-isi/${cetakIsi.id}`
            textCetakIsi.innerText = cetakIsi.cetak_isi
        }
    </script>
@endsection
