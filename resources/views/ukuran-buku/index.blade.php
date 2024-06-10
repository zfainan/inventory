@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Ukuran Buku</h2>

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

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex">
                <div class="ms-auto">
                    <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createUkuranBuku">Tambah
                        ukuran buku</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ukuranBuku)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ukuranBuku->ukuran_buku }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $ukuranBuku->toJson() }})"
                                        onkeypress="updateModalData({{ $ukuranBuku->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editUkuranBuku">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $ukuranBuku->toJson() }})"
                                        onkeypress="updateModalData({{ $ukuranBuku->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteUkuranBuku">
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
    <div class="modal fade" id="createUkuranBuku" tabindex="-1" aria-labelledby="createUkuranBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('ukuran-buku.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUkuranBukuLabel">Tambah ukuran buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Ukuran</label><span class="text-danger">*</span>
                        <input type="text" name="ukuran_buku" class="form-control" id="input-nama" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUkuranBuku" tabindex="-1" aria-labelledby="editUkuranBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUkuranBukuLabel">Ubah Ukuran Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editUkuranBukuNameField" class="form-label">Ukuran</label>
                        <input type="text" name="ukuran_buku" class="form-control" id="editUkuranBukuNameField" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteUkuranBuku" tabindex="-1" aria-labelledby="deleteUkuranBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteUkuranBukuLabel">Hapus
                        Ukuran Buku
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data ukuran <strong><span id="textUkuran"></span></strong>?
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
        const editUkuranBukuNameField = document.getElementById('editUkuranBukuNameField')
        const deleteForm = document.getElementById('deleteForm')
        const textUkuran = document.getElementById('textUkuran')

        function updateModalData(ukuranBuku) {
            editForm.action = `/ukuran-buku/${ukuranBuku.id}`
            editUkuranBukuNameField.value = ukuranBuku.ukuran_buku
            deleteForm.action = `/ukuran-buku/${ukuranBuku.id}`
            textUkuran.innerText = ukuranBuku.ukuran_buku
        }
    </script>
@endsection
