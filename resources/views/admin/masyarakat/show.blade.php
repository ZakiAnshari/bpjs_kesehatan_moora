@extends('layouts.admin')
@section('title', 'User')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('masyarakat.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                        <span class="fw-normal">Kembali</span>
                    </button>
                </a>
            </div>

            <div class="card-body">
                <div class="text-nowrap">
                    <div class="row">
                        <!-- Kartu Kiri (Foto dan Nama) -->
                        <div class="col-lg-12 mb-4">
                            <div class="h-100">
                                <div class="position-relative">
                                    <!-- Foto Avatar -->
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto mb-3">
                                            <img src="{{ asset('backend/assets/img/avatars/provil.jpg') }}" alt="user-image"
                                                class="user-avatar img-fluid"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 11px;">
                                        </div>
                                        <h5 class="mb-1">{{ $masyarakats->nama }}</h5>
                                        <hr class="my-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Kanan (Detail Lengkap) -->
                        <div class="col-lg-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0">Detail Data Masyarakat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Baris 1 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Nama</label>
                                            <div class="fw-semibold">{{ $masyarakats->nama }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Pekerjaan</label>
                                            <div class="fw-semibold">{{ $masyarakats->pekerjaan }}</div>
                                        </div>

                                        <!-- Baris 2 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Penghasilan</label>
                                            <div class="fw-semibold">Rp
                                                {{ number_format($masyarakats->penghasilan, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Jumlah Tanggungan</label>
                                            <div class="fw-semibold">{{ $masyarakats->jumlah_tanggungan }}</div>
                                        </div>

                                        <!-- Baris 3 -->
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Status Rumah</label>
                                            <div class="fw-semibold">{{ $masyarakats->status_rumah }}</div>
                                        </div>
                                        <div class="col-md-6 border-bottom pb-3 mb-3">
                                            <label class="text-muted mb-1">Pendidikan</label>
                                            <div class="fw-semibold">{{ $masyarakats->pendidikan }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

    @include('sweetalert::alert')
@endsection
