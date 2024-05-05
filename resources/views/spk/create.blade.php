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
                    <select class="form-select" name="id_ukuran_buku" id="input-booksize" required>
                        <option selected disabled>Pilih ukuran buku</option>
                        @foreach ($ukuranBuku as $ukBuku)
                            <option value="{{ $ukBuku->id }}">{{ $ukBuku->ukuran_buku }}</option>
                        @endforeach
                    </select>

                    @error('id_ukuran_buku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-ukuran-kertas" class="form-label">Ukuran kertas</label>
                    <select class="form-select" name="id_ukuran_kertas" id="input-ukuran-kertas" required>
                        <option selected disabled>Pilih ukuran kertas</option>
                        @foreach ($ukuranKertas as $ukKertas)
                            <option value="{{ $ukKertas->id }}">{{ $ukKertas->ukuran }} -
                                {{ $ukKertas->grammatur?->grammatur }}gr - {{ $ukKertas->kertasIsi?->kertas_isi }}</option>
                        @endforeach
                    </select>

                    @error('id_ukuran_kertas')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-cetak-isi" class="form-label">Cetak isi</label>
                    <select class="form-select" name="id_cetak_isi" id="input-cetak-isi" required>
                        <option selected disabled>Pilih cetak isi</option>
                        @foreach ($cetakIsi as $isi)
                            <option value="{{ $isi->id }}">{{ $isi->cetak_isi }}</option>
                        @endforeach
                    </select>

                    @error('id_cetak_isi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-finishing" class="form-label">Finishing</label>
                    <select class="form-select" name="id_finishing" id="input-finishing" required>
                        <option selected disabled>Pilih finishing</option>
                        @foreach ($finishing as $item)
                            <option value="{{ $item->id }}">{{ $item->finishing }}</option>
                        @endforeach
                    </select>

                    @error('id_finishing')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <a href="{{ route('spk.index') }}" type="button" class="btn btn-outline-light mt-4 me-2">Batal</a>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>

            </form>
        </div>
    </div>
@endsection
