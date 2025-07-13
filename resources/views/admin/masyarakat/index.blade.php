@extends('layouts.admin')
@section('title', 'Alternatif')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
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
                                <h5 class="pb-2 border-bottom">Table Alternatif</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Form Search -->
                                    <form method="GET" class="d-flex align-items-center my-3" style="max-width: 350px;">
                                        <div class="input-group shadow-sm" style="height: 38px; width: 100%;">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control border-end-0 py-2 px-3" style="font-size: 0.9rem;"
                                                placeholder="Cari Nama" aria-label="Search">
                                            <button class="btn btn-outline-primary px-3" type="submit"
                                                style="font-size: 0.9rem;">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Judul -->
                                    <!-- Tombol Aksi -->
                                    @auth
                                        @if (auth()->user()->role_id != 3)
                                            <div class="d-flex gap-2">
                                                <button type="button"
                                                    class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#addProductModal">
                                                    <i class="bx bx-plus me-2 d-block"></i>
                                                    <span>Tambah</span>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth

                                </div>

                                <!-- Modal tambah Data -->
                                <div class="modal fade" id="addProductModal" tabindex="-1"
                                    aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <!-- Judul -->
                                            <div class="modal-header border-bottom pb-2">
                                                <h5 class="modal-title" id="addProductModalLabel">Tambah Data Masyarakat
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="masyarakat-add" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Kolom Kiri -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama
                                                                    Lengkap</label>
                                                                <input type="text" name="nama" class="form-control"
                                                                    id="nama" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="penghasilan" class="form-label">Penghasilan
                                                                    (Rp)</label>
                                                                <input type="text" name="penghasilan"
                                                                    class="form-control" id="penghasilan"
                                                                    oninput="formatRupiah(this)" placeholder="Rp." required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="jumlah_tanggungan" class="form-label">Jumlah
                                                                    Tanggungan</label>
                                                                <input type="number" name="jumlah_tanggungan"
                                                                    class="form-control" id="jumlah_tanggungan" required>
                                                            </div>
                                                        </div>

                                                        <!-- Kolom Kanan -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                                <select name="pekerjaan" id="pekerjaan" class="form-select"
                                                                    required>
                                                                    <option value="" disabled selected>-- Pilih --
                                                                    </option>
                                                                    <option value="Tidak Bekerja / IRT">Tidak Bekerja / IRT
                                                                    </option>
                                                                    <option value="Buruh Harian Lepas">Buruh Harian Lepas
                                                                    </option>
                                                                    <option value="Sopir">Sopir</option>
                                                                    <option value="Petani">Petani</option>
                                                                    <option value="WiraSwasta">WiraSwasta</option>
                                                                    <option value="Karyawan">Karyawan</option>
                                                                    <option value="Dosen">Dosen</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status_rumah" class="form-label">Status
                                                                    Rumah</label>
                                                                <select name="status_rumah" id="status_rumah"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih --
                                                                    </option>
                                                                    <option value="Menumpang">Menumpang</option>
                                                                    <option value="Sewa">Sewa</option>
                                                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="pendidikan" class="form-label">Pendidikan
                                                                    Terakhir</label>
                                                                <select name="pendidikan" id="pendidikan"
                                                                    class="form-select" required>
                                                                    <option value="" disabled selected>-- Pilih --
                                                                    </option>
                                                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                                    <option value="SD/SMP">SD/SMP</option>
                                                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                                                    <option value="Perguruan Tinggi">Perguruan Tinggi
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Tombol -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- Table Data -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Nama</th>
                                            <th>Pekerjaan</th>

                                            <th>Status Rumah</th>
                                            <th>Pendidikan</th>
                                            @unless (auth()->user()->role_id == 3)
                                                <th class="text-center" style="width: 80px;">Aksi</th>
                                            @endunless
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($masyarakats as $index => $item)
                                            <tr>
                                                <td>{{ $masyarakats->firstItem() + $index }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->pekerjaan }}</td>

                                                <td>{{ $item->status_rumah }}</td>
                                                <td>{{ $item->pendidikan }}</td>

                                                @if (auth()->check() && auth()->user()->role_id != 3)
                                                    <td>
                                                        <a href="{{ url('masyarakat-show/' . $item->id) }}"
                                                            class="btn btn-icon btn-outline-info" title="Lihat Data">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                        <a href="{{ url('masyarakat-edit/' . $item->id) }}"
                                                            class="btn btn-icon btn-outline-primary" title="Edit Data">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmDeleteMasyarakat({{ $item->id }}, @js($item->nama))"
                                                            style="display:inline;">
                                                            <button class="btn btn-icon btn-outline-danger">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data masyarakat kosong.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>


                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $masyarakats->appends(request()->input())->links('pagination::bootstrap-4') }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteMasyarakat(id, nama) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${nama}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/masyarakat-destroy/${id}`;
                }
            });
        }
    </script>

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

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = 'Rp. ' + rupiah;
        }
    </script>

    <script>
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('tanggal').setAttribute('min', today);
        document.getElementById('jatuh_tempo').setAttribute('min', today);
    </script>


    @include('sweetalert::alert')
@endsection
