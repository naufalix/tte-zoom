@extends('layouts.auth')

@section('content')
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/ceres-html-pro/assets/media/illustrations/dozzy-1/14.png">
  <!--begin::Content-->
  <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
    <!--begin::Wrapper-->
    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
      <div class="row mb-10">
        <div class="d-flex mx-auto mb-10 justify-content-center">
          <img alt="Logo" src="/assets/img/logo.png" class="h-50px w-auto" />
          <span class="text-dark ms-3 my-auto fw-bold" style="line-height: 20px">
            <i class="text-dark">Menuju Masyarakat</i><br>
            <i class="text-dark">Informasi Indonesia</i>
          </span>
        </div> 
        <h1 class="text-center">Sistem TTE & Zoom</h1>
      </div>
      <!--begin::Form-->
        <div class="text-center">
          <a href="/dashboard" class="btn btn-lg btn-success w-100 mb-5">Masuk</a>
        </div>
      <!--end::Form-->

    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Content-->
  <!--begin::Footer-->
  <div class="d-flex flex-center flex-column-auto p-10">
    <!--begin::Links-->
    <div class="d-flex align-items-center fw-bold fs-6">
      <span>Developed by <a href="https://naufal.dev" class="text-muted text-hover-primary px-2">naufal.dev</a></span>
    </div>
    <!--end::Links-->
  </div>
  <!--end::Footer-->
</div>
@endsection