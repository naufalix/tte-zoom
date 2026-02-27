@extends('layouts.dashboard')

@section('content')

<div class="card mb-2 col-md-7">
  <!--begin::Card Body-->
  <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
    <!--begin::Section-->
    <div>
      <!--begin::Heading-->
      <div class="col-12 d-flex">
        <h1 class="anchor fw-bolder mb-5" id="striped-rounded-bordered">Booking Zoom</h1>
      </div>
      <!--end::Heading-->
      <hr>
      <!--begin::Block-->
      <div class="mt-5">
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="mb-5 col-12 col-md-6">
                  <label class="form-label fs-6 fw-bolder text-dark">Nama pemohon :</label>
                  <input type="text" class="form-control" name="name" required placeholder="Nama pemohon">
                </div>
                <div class="mb-5 col-12 col-md-6">
                  <label class="form-label fs-6 fw-bolder text-dark">Gender :</label>
                  <select class="form-select" name="gender" required>
                    <option value="" disabled selected>- Pilih gender- </option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>                
                <div class="mb-5 col-12 col-md-6">
                  <label class="form-label fs-6 fw-bolder text-dark">Tanggal permohonan :</label>
                  <input type="date" class="form-control" name="submission_date" required>
                </div>
                <div class="mb-5 col-12 col-md-6">
                  <label class="form-label fs-6 fw-bolder text-dark">Perangkat daerah :</label>
                  <input type="text" class="form-control" name="company" required placeholder="Desa Lowokwaru">
                </div>
                <input type="hidden" name="type" value="Booking Zoom"> 
              </div>
            </div>
          </div>
          <div class="modal-footer p-0">
            <button type="submit" class="btn btn-primary" name="submit" value="store">Simpan</button>
          </div>
        </form> 
      </div>
      <!--end::Block-->
    </div>
    <!--end::Section-->
  </div>
  <!--end::Card Body-->
</div>


<script type="text/javascript">
  function foto(image){
    $("#img-view").attr("src","/storage/img/absent/"+image);
  }
  function edit(id){
    $.ajax({
      url: "/api/reservation_approval/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $('#edit input[name="id"]').val(id);
        $('#edit input[name="comment"]').val(mydata.comment);
        $('#edit select[name="status"]').val(mydata.status);
        $("#level").text(mydata.approval_level);
      }
    });
  }

  let leafletMap;
  let marker;

  function map(lat, lng) {
    // buka modal
    $('#map').modal('show');

    // delay dikit biar modal kebuka dulu
    setTimeout(() => {
      if (!leafletMap) {
        leafletMap = L.map('map-view').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap'
        }).addTo(leafletMap);

        marker = L.marker([lat, lng]).addTo(leafletMap);
      } else {
        leafletMap.setView([lat, lng], 15);
        marker.setLatLng([lat, lng]);
      }

      leafletMap.invalidateSize();
    }, 300);
  }
</script>

@endsection