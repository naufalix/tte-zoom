@extends('layouts.dashboard')

@section('content')

<!--begin::Card-->
<div class="d-flex" style="height: 80vh">
  <div class="row my-auto col-12">
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <a href="/dashboard/tte-elektronik">
          <div class="card-body">
            <button class="btn btn-icon rounded-circle mb-3" style="border: 1px solid #f8285a">
              <i class="fa fa-file-text fs-4 "></i>
            </button>
            <h2>Tanda Tangan Elektronik (TTE)</h2>
            <p class="text-dark">Pengajuan dan Pengelolaan Tanda Tanga Elektronik</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <a href="/dashboard/booking-zoom">
          <div class="card-body">
            <button class="btn btn-icon rounded-circle mb-3" style="border: 1px solid #f8285a">
              <i class="bi bi-chat-left-dots-fill fs-4 "></i>
            </button>
            <h2>Booking Zoom</h2>
            <p class="text-dark">Layanan Pemohonan dan Penjadwalan Layanan Zoom</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <a href="/dashboard/laporan">
          <div class="card-body">
            <button class="btn btn-icon rounded-circle mb-3" style="border: 1px solid #f8285a">
              <i class="bi bi-display fs-4 "></i>
            </button>
            <h2>Menu Laporan</h2>
            <p class="text-dark">Melihat dan Meringkas Laporan Layanan</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<!--end::Card-->




@endsection