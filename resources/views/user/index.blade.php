@extends('layouts.app')

@section('content')
    <h2 class="h4">Data User</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">Tambah
                user</a>
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
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <p class="mb-0">{{ $user->name }}</p>
                        <span>{{ $user->email }}</span>
                    </td>
                    <td>{{ $user->petugas->jabatan }}</td>
                    <td>
                        <button class="badge rounded border-0" title="delete" data-bs-toggle="modal"
                            data-bs-target="#deleteUser{{ $user->id }}">
                            <i class="text-danger h4 mdi mdi-delete menu-icon"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Hapus User -->
                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1"
                    aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteUser{{ $user->id }}Label">Konfirmasi Hapus
                                    Pengguna
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin akan menghapus akun milik {{ $user->name }}?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
    <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('users.store') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUserLabel">Tambah user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="input-nama" class="form-label">Nama</label><span class="text-danger">*</span>
                        <input type="text" name="name" class="form-control" id="input-nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-jabatan" class="form-label">Role/Jabatan</label><span class="text-danger">*</span>
                        <select class="form-select" name="jabatan" id="input-penerbit" required>
                            <option selected disabled>Pilih jabatan</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item->value }}">{{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-email" class="form-label">Email</label><span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control" id="input-email" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-password" class="form-label">Password</label><span class="text-danger">*</span>
                        <input type="password" name="password" class="form-control" id="input-password" required>
                    </div>

                    <div class="mb-3">
                        <label for="input-password_confirmation" class="form-label">Konfirmasi Password</label><span class="text-danger">*</span>
                        <input type="password" name="password_confirmation" class="form-control" id="input-password_confirmation" required aria-describedby="passHelp">
                        <div id="passHelp" class="form-text">Simpan password di tempat yang aman.</div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
