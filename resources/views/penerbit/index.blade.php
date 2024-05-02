@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Penerbit</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="{{ route('buku.create') }}" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#createPenerbit">Buat Penerbit</a>
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
                <th scope="col">Nama Penerbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $penerbit)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $penerbit->penerbit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal -->
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
@endsection
