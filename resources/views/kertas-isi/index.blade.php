@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Kertas Isi</h2>

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
                        data-bs-target="#createKertasIsi">Tambah
                        kertas isi</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kertas isi</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $kertasIsi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kertasIsi->kertas_isi }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $kertasIsi->toJson() }})"
                                        onkeypress="updateModalData({{ $kertasIsi->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editKertasIsi">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $kertasIsi->toJson() }})"
                                        onkeypress="updateModalData({{ $kertasIsi->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteKertasIsi">
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
    <div class="modal fade" id="createKertasIsi" tabindex="-1" aria-labelledby="createKertasIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('kertas-isi.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createKertasIsiLabel">Tambah kertas isi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Kertas isi</label><span class="text-danger">*</span>
                        <input type="text" name="kertas_isi" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editKertasIsi" tabindex="-1" aria-labelledby="editKertasIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editKertasIsiLabel">Ubah Kertas Isi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editKertasIsiNameField" class="form-label">Kertas Isi<span class="text-danger">*</span></label>
                        <input type="text" name="kertas_isi" class="form-control" id="editKertasIsiNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteKertasIsi" tabindex="-1" aria-labelledby="deleteKertasIsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteKertasIsiLabel">Hapus
                        Kertas Isi
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data kertas isi <strong><span id="textKertasIsi"></span></strong>?
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
        const editKertasIsiNameField = document.getElementById('editKertasIsiNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textKertasIsi = document.getElementById('textKertasIsi')

        function updateModalData(kertasIsi) {
            editForm.action = `/kertas-isi/${kertasIsi.id}`
            editKertasIsiNameField.value = kertasIsi.kertas_isi
            deleteForm.action = `/kertas-isi/${kertasIsi.id}`
            textKertasIsi.innerText = kertasIsi.kertas_isi
        }
    </script>
@endsection
