@extends('layouts.app')

@section('content')
    <h2 class="h4">Data Distributor</h2>

    <div class="d-flex">
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#createDistributor">Tambah distributor</a>
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
                <th scope="col">Nama Distributor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $distributor)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $distributor->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

    <!-- Modal -->
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
@endsection
