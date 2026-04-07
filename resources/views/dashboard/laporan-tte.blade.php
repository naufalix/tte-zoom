@extends('layouts.dashboard')

@section('content')

<div class="card mb-2">
  <!--begin::Card Body-->
  <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
    <!--begin::Section-->
    <div>
      <!--begin::Heading-->
      <div class="col-12 d-flex">
        <h1 class="anchor fw-bolder mb-5">Riwayat Laporan TTE</h1>
      </div>
      <!--end::Heading-->

      <!--begin::Block-->
      <div class="my-5">
        <div class="row mb-5">
    
          <!-- Total Permohonan -->
          <div class="col-12 col-md-3 mb-3">
            <div class="card bg-light-info">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="text-muted mb-3">Total Permohonan</h3>
                  <h2 class="fw-bolder text-info h1 mb-0">
                    {{ $letters->count() }}
                  </h2>
                </div>
                <div class="text-primary">
                  <i class="bi bi-archive fs-1"></i>
                </div>
              </div>
            </div>
          </div>
      
          <!-- TTE Selesai -->
          <div class="col-12 col-md-3 mb-3">
            <div class="card bg-light-success">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="text-muted mb-3">TTE Selesai</h3>
                  <h2 class="fw-bolder text-success h1 mb-0">
                    {{ $done }}
                  </h2>
                </div>
                <div class="text-primary">
                  <i class="bi bi-check-circle-fill fs-1"></i>
                </div>
              </div>
            </div>
          </div>
      
          <!-- Menunggu Proses -->
          <div class="col-12 col-md-3 mb-3">
            <div class="card bg-light-warning">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="text-muted mb-3">Menunggu Proses</h3>
                  <h2 class="fw-bolder text-warning h1 mb-0">
                    {{ $waiting }}
                  </h2>
                </div>
                <div class="text-primary">
                  <i class="bi bi-file-earmark-check-fill fs-1"></i>
                </div>
              </div>
            </div>
          </div>
        
        </div>
      </div>
      <!--end::Block-->

      <!--begin::Block-->
      <div class="col-12 d-flex mb-3">
        <button class="btn btn-success me-3 ms-md-0 ms-auto" onClick="dataexport('print')" style="zoom:80%; height: fit-content">Print</button>
        <button class="btn btn-danger me-3" onClick="dataexport('pdf')" style="zoom:80%; height: fit-content">PDF</button>
        <button class="btn btn-primary me-md-0 me-auto" data-bs-toggle="modal" data-bs-target="#filter" style="zoom:80%; height: fit-content">Filter</button>
      </div>
      <!--end::Block-->

      <!--begin::Block-->
      <div class="table-responsive">
        
        <table id="myTable" class="table table-striped table-hover table-rounded border gs-7">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
              <th class="width: 30px">No</th>
              <th style="min-width: 120px">Tanggal masuk</th>
              <th style="min-width: 150px">Layanan</th>
              <th style="min-width: 200px">Nama pemohon</th>
              <th style="min-width: 200px">Instansi/Perangkat daerah</th>
              <th>Satus</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($letters as $l)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $l->submission_date }}</td>
              <td>
                {{ $l->type }} 
                @if($l->hour) ({{ $l->hour }}) @endif              
              </td>
              <td>{{ $l->name }}</td>
              <td>{{ $l->company }}</td>
              <td>
                @if($l->status==1)
                  <span class="badge badge-success">Selesai</span>
                @else
                  <span class="badge badge-warning">Diproses</span>
                @endif
              </td>
              <td>
                <a href="#" class="btn btn-icon btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $l->id }})"><i class="bi bi-pencil-fill"></i></a>
                <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $l->id }})"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!--end::Block-->
    </div>
    <!--end::Section-->
  </div>
  <!--end::Card Body-->
</div>

<div class="modal fade" tabindex="-1" id="filter">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="et">Filter laporan</h3>
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="bi bi-x-lg"></i>
        </div>
      </div>
      <form class="form" method="post" action="">
        @csrf
        <div class="modal-body">
          <div class="row g-9">
            
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Bulan awal :</label>
              <input type="month" class="form-control" name="month_start" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="required fw-bold mb-2">Bulan akhir :</label>
              <input type="month" class="form-control" name="month_end" required>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success" name="submit" value="filter">Filter</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="edit">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="et">Edit pengajuan</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama pemohon :</label>
                <input type="text" class="form-control" name="name" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="fw-bold mb-2">Jabatan :</label>
                <input type="text" class="form-control" name="position">
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Gender :</label>
                <select class="form-control form-select" name="gender" required>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Tanggal permohonan :</label>
                <input type="date" class="form-control" name="submission_date" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Perangkat daerah :</label>
                <input type="text" class="form-control" name="company" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Jenis TTE :</label>
                <select class="form-control form-select" name="type" required>
                  <option value="Permintaan TTE Baru">Permintaan TTE Baru</option>
                  <option value="Membuat Pass Phrase">Membuat Pass Phrase</option>
                  <option value="Reset Pass Phrase">Reset Pass Phrase</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-control form-select" name="status" required>
                  <option value="0">Diproses</option>
                  <option value="1">Selesai</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success" name="submit" value="update">Simpan</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="hapus">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Hapus pengajuan</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body text-center">
            <input type="hidden" class="d-none" id="hi" name="id">
            <p class="fw-bold mb-2 fs-4" id="hd">Apakah anda yakin ingin menghapus pengajuan ini?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger" name="submit" value="destroy">Hapus</button>
          </div>
        </form>
      </div>
  </div>
</div>

<script type="text/javascript">
  // function updateStatus(el) {
  //   const label = document.getElementById("statusLabel");
  //   if (el.checked) {
  //     label.textContent = "Selesai";
  //     el.value = "1";
  //   } else {
  //     label.textContent = "Diproses";
  //     el.value = "0";
  //   }
  // }
  function edit(id){
    $.ajax({
      url: "/api/letter/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $('#edit input[name="id"]').val(id);
        $('#edit input[name="name"]').val(mydata.name);
        $('#edit select[name="gender"]').val(mydata.gender);
        $('#edit input[name="position"]').val(mydata.position);
        $('#edit input[name="submission_date"]').val(mydata.submission_date);
        $('#edit input[name="company"]').val(mydata.company);
        $('#edit select[name="type"]').val(mydata.type);
        $('#edit select[name="status"]').val(mydata.status);
      }
    });
  }
  function hapus(id){
    $("#hi").val(id);
  }
</script>

@endsection