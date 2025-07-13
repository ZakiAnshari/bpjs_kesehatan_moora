<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Perhitungan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                font-size: 12px;
                color: #000;
            }

            table th,
            table td {
                font-size: 12px !important;
                padding: 8px !important;
            }
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase">LAPORAN HASIL PERHITUNGAN</h2>
            <h5 class="mt-2">Sistem Pendukung Keputusan untuk Menentukan Masyarakat yang Berhak Menerima Bantuan
                Kesehatan</h5>
            <h6 class="text-muted">Menggunakan Metode MOORA - BPJS Kesehatan Kota Padang Panjang</h6>
        </div>



        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered align-middle text-nowrap mb-0">
                <thead class="table-lights">
                    <tr>
                        <th style="width: 5px">No</th>

                        <th>Alternatif</th>
                        <th>Pekerjaan</th>
                        <th>Status Rumah</th>
                        <th>Pendidikan Terakhir</th>
                        <th class="text-center">Nilai Preferensi</th>
                        <th class="text-center">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rank = 1; @endphp
                    @forelse ($preferensi as $id => $nilai)
                        @php
                            $masyarakat = $masyarakats->firstWhere('id', $id);
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $masyarakats->find($id)->nama }}</td>
                            <td>{{ $masyarakats->find($id)->pekerjaan }}</td>
                            <td>{{ $masyarakats->find($id)->status_rumah }}</td>
                            <td>{{ $masyarakats->find($id)->pendidikan }}</td>
                            <td class="text-center">{{ number_format($nilai, 4) }}</td>
                            <td class="text-center">{{ $rank++ }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>


        <!-- Bagian Tanda Tangan -->
        <div class="row mt-5">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <p class="mb-1">{{ \Carbon\Carbon::now()->translatedFormat('l') }},
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="mb-5">Kepala Cabang BPJS Kesehatan</p>
                <p class="fw-bold text-uppercase mb-1">Drs. H. Ahmad Yani, M.M</p>
                <p class="mb-0">NIP: 19720304 199601 1 003</p>
            </div>
        </div>

        <script type="text/javascript">
            window.print();
        </script>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>
