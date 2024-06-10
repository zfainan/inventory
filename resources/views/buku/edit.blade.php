@extends('layouts.app')

@section('content')
    <h2 class="h4">Edit Data Buku</h2>

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('buku.update', $buku) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="input-judul" class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" id="input-judul" required
                        value="{{ $buku->judul }}">

                    @error('judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" id="input-isbn" value="{{ $buku->isbn }}">

                    @error('isbn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-penerbit" class="form-label">Penerbit</label>
                    <select class="form-select" name="id_penerbit" id="input-penerbit" required>
                        <option selected disabled>Pilih penerbit</option>
                        @foreach ($penerbit as $item)
                            <option @selected($item->id == $buku->id_penerbit) value="{{ $item->id }}">{{ $item->penerbit }}</option>
                        @endforeach
                    </select>

                    @error('id_penerbit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-expired" class="form-label">Expired</label>
                    <input type="date" name="expired" class="form-control" id="input-expired"
                        value="{{ $buku->expired }}">

                    @error('expired')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-booksize" class="form-label">Ukuran buku</label>
                    <select class="form-select" name="id_ukuran_buku" id="input-booksize" required>
                        <option selected disabled>Pilih ukuran buku</option>
                        @foreach ($ukuranBuku as $ukBuku)
                            <option @selected($ukBuku->id == $buku->detailMaterial->id_ukuran_buku) value="{{ $ukBuku->id }}">{{ $ukBuku->ukuran_buku }}
                            </option>
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
                        @foreach ($ukuranKertas as $item)
                            <option @selected($item->id == $buku->detailMaterial->id_ukuran_kertas) value="{{ $item->id }}">{{ $item->ukuran }} -
                                {{ $item->grammatur?->grammatur }}gr - {{ $item->kertasIsi?->kertas_isi }}
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
                        @foreach ($cetakIsi as $item)
                            <option @selected($item->id == $buku->detailMaterial->id_cetak_isi) value="{{ $item->id }}">{{ $item->cetak_isi }}
                            </option>
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
                            <option @selected($item->id == $buku->detailMaterial->id_finishing) value="{{ $item->id }}">{{ $item->finishing }}
                            </option>
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
