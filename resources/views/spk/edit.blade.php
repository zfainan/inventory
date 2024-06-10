@extends('layouts.app')

@section('content')
    <h2 class="h4">Edit SPK</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('spk.update', $spk) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nomor_spk" class="form-label">Nomor SPK</label>
                    <input type="text" class="form-control" disabled id="nomor_spk" required
                        value="{{ $spk->nomor_spk }}">
                </div>

                <div class="mb-3">
                    <label for="input-buku" class="form-label">Buku</label>
                    <select class="form-select" name="id_buku" id="input-buku" required>
                        <option selected disabled>Pilih buku</option>
                        @foreach ($books as $book)
                            <option @selected($book->id == $spk->id_buku) value="{{ $book->id }}">{{ $book->judul }}</option>
                        @endforeach
                    </select>

                    @error('id_buku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-in-date" class="form-label">Tanggal masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" id="input-in-date" required
                        value="{{ $spk->tanggal_masuk }}">

                    @error('tanggal_masuk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-out-date" class="form-label">Tanggal keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" id="input-out-date" required
                        value="{{ $spk->tanggal_keluar }}">

                    @error('tanggal_keluar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-opdasar" class="form-label">Oplah dasar</label>
                    <input type="number" class="form-control" name="oplah_dasar" id="input-opdasar" required
                        value="{{ $spk->oplah_dasar }}">

                    @error('oplah_dasar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-opinsheet" class="form-label">Oplah insheet</label>
                    <input type="number" class="form-control" name="oplah_insheet" id="input-opinsheet" required
                        value="{{ $spk->oplah_insheet }}">

                    @error('oplah_insheet')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <a href="{{ route('spk.index') }}" type="button" class="btn btn-outline-light me-2 mt-4">Batal</a>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>

            </form>
        </div>
    </div>
@endsection
