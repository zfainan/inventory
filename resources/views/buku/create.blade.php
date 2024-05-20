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
                                {{ $ukKertas->grammatur?->grammatur }}gr - {{ $ukKertas->kertasIsi?->kertas_isi }}
                            </option>
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

                <button type="submit" class="btn btn-primary my-4">Simpan</button>
            </form>
        </div>
    </div>
@endsection
