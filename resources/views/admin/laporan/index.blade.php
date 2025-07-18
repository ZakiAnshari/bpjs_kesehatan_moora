@extends('layouts.admin')
@section('title', 'Laporan')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">

                            <h5>Table Laporan</h5>
                            <div class="d-flex justify-content-between align-items-center">

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <a href="{{ route('laporan.cetak') }}" class="btn btn-warning d-flex align-items-center"
                                        role="button" target="_blank">
                                        <i class="bx bx-printer me-1"></i> Cetak
                                    </a>
                                </div>
                            </div>


                            <!-- Table Data -->
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>

                                        <th>Alternatif</th>
                                        <th>Pekerjaan</th>
                                        <th>Status Rumah</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th class="text-center">Nilai Preferensi</th>
                                        <th class="text-center">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $ranking = 1; @endphp
                                    @foreach ($preferensi as $id => $yi)
                                        <tr>

                                            <td>{{ $masyarakats->find($id)->nama }}</td>
                                            <td>{{ $masyarakats->find($id)->pekerjaan }}</td>
                                            <td>{{ $masyarakats->find($id)->status_rumah }}</td>
                                            <td>{{ $masyarakats->find($id)->pendidikan }}</td>
                                            <td class="text-center">
                                                <strong>{{ number_format($yi, 4) }}</strong>
                                            </td>
                                            <td class="text-center">
                                                {{ $ranking++ }}
                                            </td>
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
    @include('sweetalert::alert')
@endsection
