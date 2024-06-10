@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Ukuran Kertas</h2>

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
                        data-bs-target="#createUkuranKertas">Tambah
                        ukuran kertas</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Kertas isi</th>
                        <th scope="col">Grammatur</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ukuranKertas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ukuranKertas->ukuran }}</td>
                            <td>{{ $ukuranKertas->kertasIsi?->kertas_isi }}</td>
                            <td>{{ $ukuranKertas->grammatur?->grammatur }} gr</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <button onclick="updateModalData({{ $ukuranKertas->toJson() }})"
                                        onkeypress="updateModalData({{ $ukuranKertas->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#editUkuranKertas">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </button>
                                    <button onclick="updateModalData({{ $ukuranKertas->toJson() }})"
                                        onkeypress="updateModalData({{ $ukuranKertas->toJson() }})"
                                        class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteUkuranKertas">
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
    <div class="modal fade" id="createUkuranKertas" tabindex="-1" aria-labelledby="createUkuranKertasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('ukuran-kertas.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUkuranKertasLabel">Tambah ukuran kertas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Ukuran</label><span class="text-danger">*</span>
                        <input type="text" name="ukuran" class="form-control" id="input-nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-kertas-isi" class="form-label">Kertas isi<span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kertas_isi" id="input-kertas-isi" required>
                            <option selected disabled>Pilih kertas isi</option>
                            @foreach ($kertasIsi as $item)
                                <option value="{{ $item->id }}">{{ $item->kertas_isi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-grammatur" class="form-label">Grammatur<span class="text-danger">*</span></label>
                        <select class="form-select" name="id_grammatur" id="input-grammatur" required>
                            <option selected disabled>Pilih grammatur</option>
                            @foreach ($grammatur as $item)
                                <option value="{{ $item->id }}">{{ $item->grammatur }} gr</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUkuranKertas" tabindex="-1" aria-labelledby="editUkuranKertasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUkuranKertasLabel">Ubah Ukuran Kertas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="edit-ukuran" class="form-label">Ukuran</label><span class="text-danger">*</span>
                        <input type="text" name="ukuran" class="form-control" id="edit-ukuran" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-kertas-isi" class="form-label">Kertas isi<span class="text-danger">*</span></label>
                        <select class="form-select" name="id_kertas_isi" id="edit-kertas-isi" required>
                            <option selected disabled>Pilih kertas isi</option>
                            @foreach ($kertasIsi as $item)
                                <option value="{{ $item->id }}">{{ $item->kertas_isi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-grammatur" class="form-label">Grammatur<span class="text-danger">*</span></label>
                        <select class="form-select" name="id_grammatur" id="edit-grammatur" required>
                            <option selected disabled>Pilih grammatur</option>
                            @foreach ($grammatur as $item)
                                <option value="{{ $item->id }}">{{ $item->grammatur }} gr</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteUkuranKertas" tabindex="-1" aria-labelledby="deleteUkuranKertasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteUkuranKertasLabel">Hapus
                        Ukuran Kertas
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data ukuran kertas <strong><span id="textUkuranKertas"></span></strong>?
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
        const editUkuranField = document.getElementById('edit-ukuran')
        const editKertasIsiField = document.getElementById('edit-kertas-isi')
        const editGrammaturField = document.getElementById('edit-grammatur')

        const deleteForm = document.getElementById('deleteForm')
        const textUkuranKertas = document.getElementById('textUkuranKertas')

        function updateModalData(ukuranKertas) {
            editForm.action = `/ukuran-kertas/${ukuranKertas.id}`
            editUkuranField.value = ukuranKertas.ukuran
            editKertasIsiField.value = ukuranKertas.kertas_isi.id
            editGrammaturField.value = ukuranKertas.grammatur.id

            deleteForm.action = `/ukuran-kertas/${ukuranKertas.id}`
            textUkuranKertas.innerText = `${ukuranKertas.ukuran} - ${ukuranKertas.kertas_isi.kertas_isi} - ${ukuranKertas.grammatur.grammatur} gr`
        }
    </script>
@endsection
