@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="my-auto">Welcome {{ auth()->user()->petugas->nama_petugas }}</h3>

        @if (!auth()->user()->isManager)
            <div class="row mt-4 mb-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Stok Gudang Hasil
                            </div>
                            <h3>{{ $stokGudangHasil }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Stok Gudang Retur
                            </div>
                            <h3>{{ $stokGudangRetur }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-auto my-auto">
            </div>
            <form class="col-auto ms-auto d-flex">
                <div class="input-daterange d-flex">
                    <div class="input-group">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                        <input type="text" name="since" class="form-control" value="{{ $since }}">
                    </div>
                    <div class="my-auto mx-3">to</div>
                    <div class="input-group">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                        <input type="text" name="until" class="form-control" value="{{ $until }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ms-2 my-auto">Filter</button>
            </form>
        </div>

        @if (auth()->user()->isManager)
            <h4>Gudang Hasil</h4>
        @endif

        @if (auth()->user()->isManager || auth()->user()->isPetugasGudangHasil)
            <div class="row my-4">
                <div class="col-md-4 d-flex my-2">
                    <div class="card w-100" style="align-items: stretch;">
                        <div class="card-body">
                            <div class="card-title">
                                Jumlah SPK
                            </div>
                            <h3>{{ $jumlahSpk }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex my-2" style="align-items: stretch;">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="card-title">
                                Capaian Hasil Cetak
                            </div>
                            <h3>{{ $capaian }} / {{ $targetSpk }}</h3>
                            <span>{{ $targetSpk !== 0 ? ceil(($capaian / $targetSpk) * 100) : $capaian }}%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex my-2" style="align-items: stretch;">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="card-title">
                                Jumlah Pengiriman
                            </div>
                            <h3>{{ $jumlahPengiriman }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Grafik Hasil Produksi</div>

                        <div class="card-body">
                            <canvas id="hasilProduksi"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Grafik Pengiriman</div>

                        <div class="card-body">
                            <canvas id="pengiriman"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Grafik Pengurangan Stok Gudang Hasil</div>

                        <div class="card-body">
                            <canvas id="barangKeluar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->isManager)
            <h4 class="mt-5">Gudang Retur</h4>
        @endif

        @if (auth()->user()->isManager || auth()->user()->isPetugasGudangRetur)
            <div class="row my-4">
                <div class="col-md-4 d-flex my-2">
                    <div class="card w-100" style="align-items: stretch;">
                        <div class="card-body">
                            <div class="card-title">
                                Jumlah Retur
                            </div>
                            <h3>{{ $jumlahRetur }} Pcs</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex my-2" style="align-items: stretch;">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="card-title">
                                Jumlah Buku Diperbaiki
                            </div>
                            <h3>{{ $jumlahNp }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex my-2" style="align-items: stretch;">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="card-title">
                                Jumlah Buku Dikeluarkan
                            </div>
                            <h3>{{ $jmlPenguranganGudangRetur }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Daftar buku yang di retur</div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($retur as $buku)
                                            <tr>
                                                <td>{{ $buku->buku->judul }}</td>
                                                <td>{{ $buku->jml }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Grafik Pengurangan Stok Gudang Retur</div>

                        <div class="card-body">
                            <canvas id="barangKeluarGudangRetur"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('hasilProduksi');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! $hasilCetak->pluck('tanggal')->toJson() !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! $hasilCetak->pluck('hasil')->toJson() !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        const ctx2 = document.getElementById('pengiriman');
        if (ctx2) {
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: {!! $pengiriman->pluck('tanggal')->toJson() !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! $pengiriman->pluck('hasil')->toJson() !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        const ctx3 = document.getElementById('barangKeluar');
        if (ctx3) {
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: {!! $penguranganGudangHasil->pluck('tanggal')->toJson() !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! $penguranganGudangHasil->pluck('qty')->toJson() !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        const ctx4 = document.getElementById('barangKeluarGudangRetur');
        if (ctx4) {
            new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: {!! $penguranganGudangRetur->pluck('tanggal')->toJson() !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! $penguranganGudangRetur->pluck('qty')->toJson() !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>

    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endsection
