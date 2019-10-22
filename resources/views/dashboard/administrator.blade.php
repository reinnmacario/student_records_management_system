@extends('layouts.dashboard-master')
@section('title')
<title>Dashboard | Admin</title>
@endsection

@section('styles')

@endsection
@section('content')
     <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Administrator</li>
          </ol>

<div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card dashboard-card mt-4 mb-4">
              <div class="card-body">
                <form id="form-ap">
                  @csrf
                  <div class="form-row">
                      <div class="col-md-6 offset-md-3">
                          <label class="control-label">Authorized Personnel Name <span class="required">*</span></label>
                          <input type="text" id="ap_name" name="ap_name" maxlength="150" class="form-control" value="@if(!empty($ap)) {{$ap->ap_name}} @endif" required>
                      </div>
                    </div>
                    <div class="form-row">
                       <div class="col-md-6 offset-md-3">
                        <label class="control-label">Authorized Personnel Position <span class="required">*</span></label>
                        <input type="text" id="ap_position" name="ap_position" maxlength="100" class="form-control" value="@if(!empty($ap)) {{$ap->ap_position}} @endif" required>
                      </div>
                    </div>
                    <div class="form-row mt-3">
                      <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-success btn-update-ap btn-md">Update</button>
                      </div>
                    </div>
              </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  
  $(document).ready(function() {
    $('#administrator').addClass('active');
            $(document).on('submit', '#form-ap', function(e) {
                e.preventDefault();
                    var form = $(this);
                    $.ajax({
                       type: "POST",
                       url: "/user/update-ap-info",
                       data: form.serialize(),
                       success: function(data) {
                            if (data.success === true) {
                              alert('Authorized Personnel Information Sucessfully Updated!')
                              location.reload();
                            }
                       }
                     });
            });
        });

</script>
@endsection

