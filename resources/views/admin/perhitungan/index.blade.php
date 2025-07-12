@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Normalisasi Bobot Kriteria</h5>
                            <div class="table-responsive text-nowrap">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th style="width: 5px">Kode</th>
                                            <th>Kriteria</th>
                                            <th>Normalisasi</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kriterias as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ number_format($item->bobot_normalisasi, 4) }}</td>
                                                <td>{{ $item->kepentingan }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Table Penilaian</h5>
                            <div class="table-responsive text-nowrap">

                                <!-- Table Data -->
                                <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                                    <thead class="table-primary table-light">
                                        <tr>
                                            <th style="width: 5px">No</th>
                                            <th>Nama Masyarakat</th>

                                            @foreach ($kriterias as $kriteria)
                                                <th>({{ $kriteria->kode }})</th>
                                            @endforeach

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($masyarakats as $item)
                                            @php
                                                // Ambil penilaian untuk masyarakat ini
                                                $penilaianMasyarakat = $penilaians->where('masyarakat_id', $item->id);

                                                // Cek apakah lengkap (jumlah kriteria = jumlah penilaian unik)
                                                $lengkap =
                                                    $penilaianMasyarakat
                                                        ->pluck('subkriteria.kriteria_id')
                                                        ->unique()
                                                        ->count() === $kriterias->count();
                                            @endphp

                                            @if ($lengkap)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->nama }}</td>

                                                    @foreach ($kriterias as $kriteria)
                                                        @php
                                                            $nilai = $penilaianMasyarakat
                                                                ->where('subkriteria.kriteria_id', $kriteria->id)
                                                                ->first();
                                                        @endphp
                                                        <td>
                                                            {{ $nilai?->subkriteria?->berat_kepentingan ?? '-' }}
                                                        </td>
                                                    @endforeach


                                                </tr>
                                            @endif
                                        @endforeach

                                        @if ($no === 1)
                                            <tr>
                                                <td colspan="{{ 2 + count($kriterias) }}" class="text-center">Data Kosong
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Normalisasi dan Perkalian Bobot</h5>
                            <div class="table-responsive text-nowrap">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Table: Normalisasi × Bobot -->
                                <table class="table table-bordered">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Nama</th>
                                            @foreach ($kriterias as $k)
                                                <th>{{ $k->kode }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($masyarakats as $m)
                                            <tr>
                                                <td>{{ $m->nama }}</td>
                                                @foreach ($kriterias as $k)
                                                    <td class="text-center">
                                                        {{ number_format($nilaiNormalisasi[$m->id][$k->id] ?? 0, 4) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom">Nilai Preferensi MOORA</h5>
                            <div class="table-responsive text-nowrap">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Table: Nilai Preferensi -->
                                <table class="table table-bordered">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Nama</th>
                                            @foreach ($kriterias as $k)
                                                <th>{{ $k->kode }}</th>
                                            @endforeach
                                            <th>Total</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $ranking = 1; @endphp
                                        @foreach ($preferensi as $id => $yi)
                                            <tr>
                                                <td>{{ $masyarakats->find($id)->nama }}</td>
                                                @foreach ($kriterias as $k)
                                                    <td class="text-center">
                                                        {{ number_format($nilaiNormalisasi[$id][$k->id] ?? 0, 4) }}
                                                    </td>
                                                @endforeach
                                                <td class="text-center"><strong>{{ number_format($yi, 4) }}</strong></td>
                                                <td class="text-center">{{ $ranking++ }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
