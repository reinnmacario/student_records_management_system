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
            <li class="breadcrumb-item active">Post Event Reports</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Post Event Reports</div>
            <div class="card-body">
              <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Student Organization</th>
                      <th>Event Name</th>
                      <th>Organization</th>
                      <th>Date Submitted</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Student Organization</th>
                      <th>Event Name</th>
                      <th>Organization</th>
                      <th>Date Submitted</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <tr>
                      <td>Donna Snider</td>
                      <td>Customer Support</td>
                      <td>New York</td>
                      <td>27</td>
                      <td><button type="button" class="btn btn-success btn-see-report">See Report</button></td>
                    </tr>
                  </tbody>
                </table>
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
     $('#post-event-reports').addClass('active');

  });
</script>
@endsection