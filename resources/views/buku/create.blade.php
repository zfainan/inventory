@extends('layouts.app')

@section('content')
    <h2 class="h4">Tambah Data Buku</h2>

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('buku.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="input-judul" class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" id="input-judul" required>

                    @error('judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" id="input-isbn">

                    @error('isbn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-penerbit" class="form-label">Penerbit</label>
                    <select class="form-select" name="id_penerbit" id="input-penerbit" required>
                        <option selected disabled>Pilih penerbit</option>
                        @foreach ($penerbit as $item)
                            <option value="{{ $item->id }}">{{ $item->penerbit }}</option>
                        @endforeach
                    </select>

                    @error('id_penerbit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-expired" class="form-label">Expired</label>
                    <input type="date" name="expired" class="form-control" id="input-expired">

                    @error('expired')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary my-4">Simpan</button>
            </form>
        </div>
    </div>
@endsection
