@extends('layouts.app')

@section('content')
    <h2 class="h4">Buat Surat Jalan</h2>

    @session('status')
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card my-4">
        <div class="card-body">
            <form action="{{ route('surat-jalan.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="input-petugas" class="form-label">Petugas</label><span class="text-danger">*</span>
                    <select class="form-select" name="id_petugas" id="input-petugas" required>
                        <option selected disabled>Pilih petugas</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->nama_petugas }} - {{ $employee->jabatan }}
                            </option>
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

                <div class="d-flex">
                    <button type="button" class="btn btn-primary ms-auto mb-4 mt-2 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addDetailModal">
                        <i class="mdi mdi-plus"></i> Tambah detail
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="dynamicTable">
                        <thead>
                            <tr>
                                <th>Distributor</th>
                                <th>Buku</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Distributor 1</td>
                                <td>Buku random</td>
                                <td>12</td>
                                <td>
                                    <button type="button" class="badge rounded border-0">
                                        <i class="text-danger h4 mdi mdi-delete menu-icon"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('surat-jalan.index') }}" type="button" class="btn btn-outline-light mt-4 me-2">Batal</a>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>

            </form>
        </div>
    </div>

    <!-- Modal/Pop up Tambah Detail -->
    <div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" onsubmit="event.preventDefault(); addRow()">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDetailModalLabel">Tambah Detail Surat Jalan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="input-buku" class="form-label">Buku</label><span class="text-danger">*</span>
                        <select class="form-select" name="id_buku" id="input-buku" required>
                            <option selected disabled value>Pilih buku</option>
                            @foreach ($buku as $itemBuku)
                                <option value="{{ $itemBuku->id }},{{ $itemBuku->judul }}">{{ $itemBuku->judul }} -
                                    {{ $itemBuku->penerbit->penerbit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-distributor" class="form-label">Distributor</label><span
                            class="text-danger">*</span>
                        <select class="form-select" name="id_distributor" id="input-distributor" required>
                            <option selected disabled value>Pilih distributor</option>
                            @foreach ($distributor as $itemDistributor)
                                <option value="{{ $itemDistributor->id }},{{ $itemDistributor->nama }}">
                                    {{ $itemDistributor->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="input-qty" class="form-label">Qty</label><span class="text-danger">*</span>
                        <input type="number" name="qty" class="form-control" id="input-qty" required min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="btnCloseModal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Variabel array untuk menyimpan data input detail surat jalan
        let data = [];

        // fungsi untuk memperbarui isi tabel detail surat jalan berdasarkan isi variabel data
        function updateTable() {
            const tbody = document.querySelector('#dynamicTable tbody');
            tbody.innerHTML = ''; // Kosongkan isi tabel

            // Tambahkan baris untuk setiap item dalam variabel data
            data.forEach((item, index) => {
                const row = document.createElement('tr');

                ['nama_distributor', 'judul_buku', 'qty'].forEach(col => {
                    const cell = document.createElement('td');
                    cell.textContent = item[col];
                    row.appendChild(cell);
                });

                const deleteCell = document.createElement('td');
                const deleteButton = document.createElement('button');
                deleteButton.innerHTML = `<i class="text-danger h4 mdi mdi-delete menu-icon"></i>`
                deleteButton.addEventListener('click', () => {
                    deleteRow(index);
                });
                deleteButton.type = 'button'
                deleteButton.className = 'badge rounded border-0';
                deleteCell.appendChild(deleteButton);
                row.appendChild(deleteCell);

                ['id_distributor', 'id_buku', 'qty'].forEach(col => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.value = item[col];
                    hiddenInput.type = 'hidden'
                    hiddenInput.name = `detail[${index}][${col}]`
                    deleteCell.appendChild(hiddenInput);
                });

                tbody.appendChild(row);
            });
        }

        // fungsi untuk menghapus 1 baris pada tabel
        function deleteRow(index) {
            data.splice(index, 1); // Hapus satu elemen dari array data pada posisi index
            updateTable(); // Perbarui tabel setelah menghapus data
        }

        // fungsi untuk menambah 1 baris pada tabel
        function addRow() {
            // mendapatkan data dari form input
            const distributor = document.getElementById('input-distributor')
            const buku = document.getElementById('input-buku')
            const qty = document.getElementById('input-qty')

            const idDistributor = distributor.value.split(',')[0]
            const idBuku = buku.value.split(',')[0]

            const rowData = {
                id_distributor: idDistributor,
                nama_distributor: distributor.value.replace(`${idDistributor},`, ''),
                id_buku: idBuku,
                judul_buku: buku.value.replace(`${idBuku},`, ''),
                qty: qty.value
            }

            // cek apakah sudah ada data yang memiliki buku dan distributor sama
            const existingIndex = data.findIndex(item => item.id_distributor === rowData.id_distributor && item.id_buku ===
                rowData.id_buku);

            // menyimpan data
            if (existingIndex !== -1) {
                data[existingIndex].qty = +data[existingIndex].qty + +rowData.qty
            } else {
                data.push(rowData)
            }

            // update isi tabel
            updateTable()

            // Clear input
            distributor.selectedIndex = 0
            buku.selectedIndex = 0
            qty.value = undefined

            // tutup modal/pop up
            document.getElementById('btnCloseModal').click()
        }

        // memanggil fungsi updateTable
        updateTable()
    </script>
@endsection
