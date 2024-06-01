@extends('layouts.app')

@section('content')
    <h2 class="h4">Ubah Data Hasil Cetak</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('finished-goods.update', $detailSpk) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="input-spk" class="form-label">SPK</label><span class="text-danger">*</span>
                    <select class="form-select" name="id_spk" id="input-spk" required onchange="updateBook()">
                        <option selected disabled>Pilih SPK</option>
                        @foreach ($spk as $item)
                            <option value="{{ $item->id }}" data-buku="{{ $item->buku }}"
                                @selected($item->id == $detailSpk->id_spk)>{{ $item->nomor_spk }} -
                                {{ $item->buku->judul }}</option>
                        @endforeach
                    </select>

                    @error('spk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input-judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="input-judul" value="{{ $detailSpk->buku->judul }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="input-exp" class="form-label">Exp</label>
                    <input type="text" class="form-control" id="input-exp" value="{{ $detailSpk->buku->expired }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="input-isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="input-isbn" value="{{ $detailSpk->buku->isbn }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="input-penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="input-penerbit"
                        value="{{ $detailSpk->buku->penerbit->penerbit }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="input-tanggal" class="form-label">Tanggal</label><span class="text-danger">*</span>
                    <input type="date" name="tanggal" class="form-control" id="input-tanggal" value="{{ $detailSpk->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label for="input-qty" class="form-label">Qty Masuk</label><span class="text-danger">*</span>
                    <input type="number" name="qty" class="form-control" id="input-qty" value="{{ $detailSpk->qty }}" required>
                </div>

                <a href="{{ route('finished-goods.index') }}" class="btn btn-outline-light my-4">Kembali</a>
                <button type="submit" class="btn btn-primary my-4">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateBook() {
            const selectSpk = document.getElementById('input-spk');
            const judul = document.getElementById('input-judul');
            const exp = document.getElementById('input-exp');
            const isbn = document.getElementById('input-isbn');
            const penerbit = document.getElementById('input-penerbit');

            const selectedOption = selectSpk.options[selectSpk.selectedIndex];
            const buku = JSON.parse(selectedOption.getAttribute('data-buku'));

            judul.value = buku.judul;
            exp.value = buku.expired;
            isbn.value = buku.isbn;
            penerbit.value = buku.penerbit.penerbit;
        }
    </script>
@endsection
