@extends('layouts.app')

@section('content')
    <h2 class="h4">
        Data SPK</h2>

    @if (auth()->user()->isPetugasGudangHasil)
        <div class="d-flex">
            <div class="ms-auto">
                <a href="{{ route('spk.create') }}" class="btn btn-primary">Input SPK</a>
            </div>
        </div>
    @endif

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="card mt-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="row mb-3">
                <div class="col-6 col-xl-3 d-flex mb-3">
                    <p class="mx-auto my-3 me-3">since</p>
                    <div>
                        <input type="date" name="since" class="form-control" value="{{ request()->input('since') }}">
                    </div>
                </div>
                <div class="col-6 col-xl-3 d-flex mb-3">
                    <p class="mx-auto my-3 me-3">until</p>
                    <div>
                        <input type="date" name="until" class="form-control" value="{{ request()->input('until') }}">
                    </div>
                </div>
                <div class="col-12 col-xl-5 d-flex mb-3 ms-auto">
                    <div class="ms-auto">
                        <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}"
                            placeholder="Judul buku / nomor SPK...">
                    </div>
                    <button class="btn btn-primary my-auto ms-4" type="submit">Cari</button>
                    <a href="{{ route('spk.index') }}" class="btn btn-outline-dark my-auto ms-2">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor SPK</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Keluar</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Oplah</th>
                            <th scope="col">Jumlah Barang Jadi</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $spk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $spk->nomor_spk }}</td>
                                <td>{{ $spk->tanggal_masuk }}</td>
                                <td>{{ $spk->tanggal_keluar }}</td>
                                <td>{{ $spk->buku?->judul }}</td>
                                <td>{{ $spk->oplah_insheet }}</td>
                                <td>{{ $spk->total_barang_jadi }}</td>
                                <td class="text-center">
                                    @if (auth()->user()->isPetugasGudangHasil)
                                        <a href="{{ route('spk.edit', $spk) }}"><span
                                                class="badge text-bg-warning rounded-1"><i
                                                    class="menu-icon mdi mdi-pen"></i></span></a>
                                        <button onclick="updateModalDelete({{ $spk->toJson() }})"
                                            onkeypress="updateModalDelete({{ $spk->toJson() }})"
                                            class="m-0 ms-2 border-0 p-0">
                                            <span class="badge text-bg-danger rounded-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteSpk">
                                                <i class="menu-icon mdi mdi-delete-forever"></i>
                                            </span>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if (count($data) < 1 && request()->hasAny(['since', 'until', 'keyword']))
                            <tr>
                                <td colspan="6">
                                    <p class="text-center">Data tidak ditemukan.</p>
                                </td>
                            </tr>
                        @elseif (count($data) < 1 && !request()->hasAny(['since', 'until', 'keyword']))
                            <tr>
                                <td colspan="6">
                                    <p class="text-center">Belum ada data.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Hapus Ukuran Buku -->
    <div class="modal fade" id="deleteSpk" tabindex="-1" aria-labelledby="deleteSpkLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteSpkLabel">Hapus
                        SPK
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin akan menghapus <span id="nomorSpk"></span>?
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteSpkForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const txtNomorSpk = document.getElementById('nomorSpk');
        const deleteForm = document.getElementById('deleteSpkForm');

        function updateModalDelete(spk) {
            txtNomorSpk.innerText = spk.nomor_spk
            deleteForm.action = `/spk/${spk.id}`
        }
    </script>
@endsection
