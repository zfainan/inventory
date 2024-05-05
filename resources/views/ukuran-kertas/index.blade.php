@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Ukuran Kertas</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUkuranKertas">Tambah
                ukuran kertas</a>
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
                <th scope="col">Ukuran</th>
                <th scope="col">Grammatur</th>
                <th scope="col">Kertas isi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $ukuranKertas)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $ukuranKertas->ukuran }}</td>
                    <td>{{ $ukuranKertas->grammatur?->grammatur }} gr</td>
                    <td>{{ $ukuranKertas->kertasIsi?->kertas_isi }}</td>
                    <td>
                        <button class="badge rounded border-0" title="delete" data-bs-toggle="modal"
                            data-bs-target="#deleteUkuranKertas{{ $ukuranKertas->id }}">
                            <i class="text-danger h4 mdi mdi-delete menu-icon"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus Ukuran Kertas -->
                <div class="modal fade" id="deleteUkuranKertas{{ $ukuranKertas->id }}" tabindex="-1"
                    aria-labelledby="deleteUkuranKertas{{ $ukuranKertas->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteUkuranKertas{{ $ukuranKertas->id }}Label">Hapus
                                    Kertas Isi
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin akan menghapus ukuran kertas {{ $ukuranKertas->ukuran }} - {{ $ukuranKertas->grammatur?->grammatur }}gr - {{ $ukuranKertas->kertasIsi?->kertas_isi }}?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('ukuran-kertas.destroy', $ukuranKertas) }}" method="POST">
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
    <div class="modal fade" id="createUkuranKertas" tabindex="-1" aria-labelledby="createUkuranKertasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('ukuran-kertas.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUkuranKertasLabel">Tambah kertas isi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Ukuran</label><span class="text-danger">*</span>
                        <input type="text" name="ukuran" class="form-control" id="input-nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-kertas-isi" class="form-label">Kertas isi</label>
                        <select class="form-select" name="id_kertas_isi" id="input-kertas-isi" required>
                            <option selected disabled>Pilih kertas isi</option>
                            @foreach ($kertasIsi as $item)
                                <option value="{{ $item->id }}">{{ $item->kertas_isi }} gr</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-grammatur" class="form-label">Grammatur</label>
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
@endsection
