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
            <li class="breadcrumb-item active">Post Event Records</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Post Event Records</div>
            <div class="card-body">
              <div class="form-row">
                  <div class="col-md-5">
                      <input type="text" name="search" class="form-control" placeholder="Search">
                   </div>
                   <div class="col-md-4">
                      <select type="select" class="form-control dropdown">
                          <option value="">Event Name</option>
                          <option value="">eReserve#</option>
                      </select>
                    </div> 
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success btn-search">Advanced Search</button>
                    </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>


@endsection
@section('scripts')
<script>  
  $(document).ready(function() {
     $('#search').addClass('active');

  });
</script>
@endsection