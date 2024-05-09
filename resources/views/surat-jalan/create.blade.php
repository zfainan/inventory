@extends('layouts.app')

@section('content')
    <h2 class="h4">Buat Surat Jalan</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('surat-jalan.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="input-petugas" class="form-label">Petugas</label><span class="text-danger">*</span>
                    <select class="form-select" name="id_petugas" id="input-petugas" required>
                        <option selected disabled>Pilih petugas</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->nama_petugas }} - {{ $employee->jabatan }}</option>
                        @endforeach
                    </select>

                    @error('id_petugas')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-tanggal" class="form-label">Tanggal</label><span class="text-danger">*</span>
                    <input type="date" class="form-control" name="tanggal" id="input-tanggal" required>

                    @error('tanggal')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <a href="{{ route('surat-jalan.index') }}" type="button" class="btn btn-outline-light mt-4 me-2">Batal</a>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>

            </form>
        </div>
    </div>
@endsection
