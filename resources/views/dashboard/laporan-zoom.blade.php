@extends('layouts.dashboard')

@section('content')

<div class="card mb-2">
  <!--begin::Card Body-->
  <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
    <!--begin::Section-->
    <div>
      <!--begin::Heading-->
      <div class="col-12 d-flex">
        <h1 class="anchor fw-bolder mb-5">Riwayat Laporan Zoom</h1>
      </div>
      <!--end::Heading-->

      <!--begin::Block-->
      <div class="my-5">
        <div>
          <div class="row mb-5">
      
            <!-- Total Permohonan -->
            <div class="col-12 col-md-3 mb-3">
              <div class="card bg-light-info">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="text-muted mb-3">Total Permohonan</h3>
                    <h2 class="fw-bolder text-info h1 mb-0">
                      {{ $zooms->count() }}
                    </h2>
                  </div>
                  <div class="text-primary">
                    <i class="bi bi-archive fs-1"></i>
                  </div>
                </div>
              </div>
            </div>
        
            <!-- Zoom Terjadwal -->
            <div class="col-12 col-md-3 mb-3">
              <div class="card bg-light-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="text-muted mb-3">Zoom Terjadwal</h3>
                    <h2 class="fw-bolder text-primary h1 mb-0">
                      {{ $done }}
                    </h2>
                  </div>
                  <div class="text-primary">
                    <i class="bi bi-camera-video-fill fs-1"></i>
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

        <form method="POST" class="row g-3 mb-5">
          @csrf
          <input type="hidden" name="submit" value="filter">
          
          <div class="col-auto">
            <input type="month" name="month_start" class="form-control" required>
          </div>
          
          <div class="col-auto">
            <input type="month" name="month_end" class="form-control" required>
          </div>
          
          <div class="col-auto">
            <button class="btn btn-info btn-purple" type="submit">Filter</button>
          </div>
        </form> 

        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-hover table-rounded border gs-7">
            <thead>
              <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                <th class="width: 30px">No</th>
                <th style="min-width: 120px">Tanggal masuk</th>
                <th>Jam</th>
                <th style="min-width: 200px">Nama pemohon</th>
                <th style="min-width: 200px">Instansi/Perangkat daerah</th>
                <th>Satus</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($zooms as $z)
              @php
              
              @endphp
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $z->submission_date }}</td>
                  <td>{{ $z->hour }}</td>
                  <td>{{ $z->name }}</td>
                  <td>{{ $z->company }}</td>
                  <td>
                    @if($z->status==1)
                      <span class="badge badge-success">Selesai</span>
                    @else
                      <span class="badge badge-warning">Diproses</span>
                    @endif
                  </td>
                  <td>
                    <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $z->id }})"><i class="bi bi-pencil-fill"></i></a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--end::Block-->
    </div>
    <!--end::Section-->
  </div>
  <!--end::Card Body-->
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
                <label class="fw-bold mb-2">Jam meeting :</label>
                <input type="time" class="form-control" name="hour">
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Perangkat daerah :</label>
                <input type="text" class="form-control" name="company" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-control form-select" name="status" required>
                  <option value="0">Diproses</option>
                  <option value="1">Selesai</option>
                </select>
              </div>

              {{-- <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2 d-block">Status :</label>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="1" onchange="updateStatus(this)">
                  <label class="form-check-label fw-bold" id="statusLabel" for="statusSwitch">Diproses</label>
                </div>
              </div>
              <style>
                #statusSwitch {background-color: #ffc107;border-color: #ffc107;}
                #statusSwitch:checked {background-color: #198754;border-color: #198754;}
              </style> --}}

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


<script type="text/javascript">
  function updateStatus(el) {
    const label = document.getElementById("statusLabel");
    if (el.checked) {
      label.textContent = "Selesai";
      el.value = "1";
    } else {
      label.textContent = "Diproses";
      el.value = "0";
    }
  }
  function edit(id){
    $.ajax({
      url: "/api/zoom/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $('#edit input[name="id"]').val(id);
        $('#edit input[name="name"]').val(mydata.name);
        $('#edit select[name="gender"]').val(mydata.gender);
        $('#edit input[name="submission_date"]').val(mydata.submission_date);
        $('#edit input[name="hour"]').val(mydata.hour);
        $('#edit input[name="company"]').val(mydata.company);
        $('#edit select[name="type"]').val(mydata.type);
        $('#edit select[name="status"]').val(mydata.status);
      }
    });
  }
</script>

@endsection