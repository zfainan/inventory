@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Buku</h2>

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
                    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
                </div>
            </div>

            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Expired</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->isbn ?? '-' }}</td>
                            <td>{{ $buku->penerbit?->penerbit }}</td>
                            <td>{{ $buku->expired }}</td>
                            <td class="text-center">
                                @if (auth()->user()->isPetugasGudangHasil)
                                    <a style="text-decoration: none" href="{{ route('buku.edit', $buku) }}" class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-warning rounded-1">
                                            <i class="menu-icon mdi mdi-pen"></i>
                                        </span>
                                    </a>
                                    <button onclick="updateModalData({{ $buku->toJson() }})"
                                        onkeypress="updateModalData({{ $buku->toJson() }})" class="m-0 ms-2 border-0 p-0">
                                        <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteBuku">
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

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteBuku" tabindex="-1" aria-labelledby="deleteBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteBukuLabel">Hapus
                        Buku
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus data buku <strong><span id="textBuku"></span></strong>?
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
        const deleteForm = document.getElementById('deleteForm')
        const textBuku = document.getElementById('textBuku')

        function updateModalData(buku) {
            deleteForm.action = `/buku/${buku.id}`
            textBuku.innerText = buku.judul
        }
    </script>
@endsection
