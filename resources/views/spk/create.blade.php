@extends('layouts.app')

@section('content')
    <h2 class="h4">Buat SPK</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('spk.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="input-buku" class="form-label">Buku</label>
                    <select class="form-select" name="id_buku" id="input-buku" required>
                        <option selected disabled>Pilih buku</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->judul }}</option>
                        @endforeach
                    </select>

                    @error('id_buku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-in-date" class="form-label">Tanggal masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" id="input-in-date" required>

                    @error('tanggal_masuk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-out-date" class="form-label">Tanggal keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" id="input-out-date" required>

                    @error('tanggal_keluar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-opdasar" class="form-label">Oplah dasar</label>
                    <input type="number" class="form-control" name="oplah_dasar" id="input-opdasar" required>

                    @error('oplah_dasar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-opinsheet" class="form-label">Oplah insheet</label>
                    <input type="number" class="form-control" name="oplah_insheet" id="input-opinsheet" required>

                    @error('oplah_insheet')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-booksize" class="form-label">Ukuran buku</label>
                    <input type="text" class="form-control" name="ukuran_buku" id="input-booksize" required>

                    @error('ukuran_buku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-grammatur" class="form-label">Grammatur</label>
                    <div class="input-group">
                        <input type="number" id="input-grammatur" name="grammatur" class="form-control" required>
                        <span class="input-group-text">Gram</span>
                    </div>

                    @error('grammatur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-cetak-isi" class="form-label">Cetak isi</label>
                    <input type="text" class="form-control" name="cetak_isi" id="input-cetak-isi" required>

                    @error('cetak_isi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-ukuran-kertas" class="form-label">Ukuran kertas</label>
                    <input type="text" class="form-control" name="ukuran_kertas" id="input-ukuran-kertas" required>

                    @error('ukuran_kertas')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-kertas-isi" class="form-label">Kertas isi</label>
                    <input type="text" class="form-control" name="kertas_isi" id="input-kertas-isi" required>

                    @error('kertas_isi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-finishing" class="form-label">Finishing</label>
                    <input type="text" class="form-control" name="finishing" id="input-finishing" required>

                    @error('finishing')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <a href="{{ route('spk.index') }}" type="button" class="btn btn-outline-light mt-4 me-2">Batal</a>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>

            </form>
        </div>
    </div>
@endsection
