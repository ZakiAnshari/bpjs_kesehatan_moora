@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/masyarakat">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('masyarakat-edit/' . $masyarakats->id) }}" method="POST">
                        @csrf
                        @method('POST') {{-- Jika ini update, pakai @method('PUT') atau 'PATCH' --}}
                        <div class="row">
                            {{-- Kolom Kiri --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        value="{{ $masyarakats->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="penghasilan" class="form-label">Penghasilan (Rp)</label>
                                    <select name="penghasilan" id="penghasilan" class="form-select" required>
                                        <option value="" disabled
                                            {{ old('penghasilan', $masyarakats->penghasilan ?? '') == '' ? 'selected' : '' }}>
                                            -- Pilih --</option>
                                        <option value="<3000000"
                                            {{ old('penghasilan', $masyarakats->penghasilan ?? '') == '<3000000' ? 'selected' : '' }}>
                                            < Rp 3.000.000</option>
                                        <option value="3000000-5000000"
                                            {{ old('penghasilan', $masyarakats->penghasilan ?? '') == '3000000-5000000' ? 'selected' : '' }}>
                                            Rp 3.000.000 - Rp 5.000.000</option>
                                        <option value=">5000000"
                                            {{ old('penghasilan', $masyarakats->penghasilan ?? '') == '>5000000' ? 'selected' : '' }}>
                                            > Rp 5.000.000</option>
                                    </select>
                                </div>



                                <div class="mb-3">
                                    <label for="jumlah_tanggungan" class="form-label">Jumlah Tanggungan</label>
                                    <input type="number" name="jumlah_tanggungan" class="form-control"
                                        id="jumlah_tanggungan" value="{{ $masyarakats->jumlah_tanggungan }}" required>
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <select name="pekerjaan" id="pekerjaan" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Tidak Bekerja / IRT"
                                            {{ $masyarakats->pekerjaan == 'Tidak Bekerja / IRT' ? 'selected' : '' }}>Tidak
                                            Bekerja / IRT</option>
                                        <option value="Buruh Harian Lepas"
                                            {{ $masyarakats->pekerjaan == 'Buruh Harian Lepas' ? 'selected' : '' }}>Buruh
                                            Harian Lepas</option>
                                        <option value="Sopir" {{ $masyarakats->pekerjaan == 'Sopir' ? 'selected' : '' }}>
                                            Sopir</option>
                                        <option value="Petani" {{ $masyarakats->pekerjaan == 'Petani' ? 'selected' : '' }}>
                                            Petani</option>
                                        <option value="WiraSwasta"
                                            {{ $masyarakats->pekerjaan == 'WiraSwasta' ? 'selected' : '' }}>WiraSwasta
                                        </option>
                                        <option value="Karyawan"
                                            {{ $masyarakats->pekerjaan == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                                        <option value="Dosen" {{ $masyarakats->pekerjaan == 'Dosen' ? 'selected' : '' }}>
                                            Dosen</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status_rumah" class="form-label">Status Rumah</label>
                                    <select name="status_rumah" id="status_rumah" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Menumpang"
                                            {{ $masyarakats->status_rumah == 'Menumpang' ? 'selected' : '' }}>Menumpang
                                        </option>
                                        <option value="Sewa"
                                            {{ $masyarakats->status_rumah == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        <option value="Milik Sendiri"
                                            {{ $masyarakats->status_rumah == 'Milik Sendiri' ? 'selected' : '' }}>Milik
                                            Sendiri</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <select name="pendidikan" id="pendidikan" class="form-select" required>
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="Tidak Sekolah"
                                            {{ $masyarakats->pendidikan == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak
                                            Sekolah</option>
                                        <option value="SD/SMP"
                                            {{ $masyarakats->pendidikan == 'SD/SMP' ? 'selected' : '' }}>SD/SMP</option>
                                        <option value="SMA/Sederajat"
                                            {{ $masyarakats->pendidikan == 'SMA/Sederajat' ? 'selected' : '' }}>
                                            SMA/Sederajat</option>
                                        <option value="Perguruan Tinggi"
                                            {{ $masyarakats->pendidikan == 'Perguruan Tinggi' ? 'selected' : '' }}>
                                            Perguruan Tinggi</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="text-end mt-3">
                                <a href="{{ route('masyarakat.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>

    <script>
        function formatRupiah(el) {
            let value = el.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>
    @include('sweetalert::alert')
@endsection
