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
            <li class="breadcrumb-item active">Projects</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Dashboard</div>
            <div class="card-body">

              <button type="button" id="btn-add-project" class="btn btn-primary">Add Project</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>eReserve No.</th>
                      <th>Event Name</th>
                      <th>Organization</th>
                      <th>College</th>
                      <th>Academic Year</th>
                      <th>Semester</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>eReserve No.</th>
                      <th>Event Name</th>
                      <th>Organization</th>
                      <th>College</th>
                      <th>Academic Year</th>
                      <th>Semester</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <tr>
                      <td>Donna Snider</td>
                      <td>Customer Support</td>
                      <td>New York</td>
                      <td>27</td>
                      <td>2011/01/25</td>
                      <td>$112,000</td>
                      <td>sad</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>

      <!-- Modal -->
    <div class="modal fade" id="add-project-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">

                <form action="" method="POST">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>eReserve No.</label>
                            <input type="text" class="form-control" name="ereserve_id" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>Event name</label>
                            <input type="text" class="form-control" name="name">
                          </div>
                          <div class="col-md-6">
                            <label>Start of Event Date</label>
                            <input type="date" class="form-control" id="date_start" name="date_start" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-row">
                            <div class="col-md-6">
                              <label>Academic Year</label>
                              <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="col-md-6">
                              <label>Semester</label>
                              <input type="text" class="form-control" id="semester" name="semester">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Event Description</label>
                          <textarea class="form-control" name="Description"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Speaker Name</label>
                          <input type="text" class="form-control" id="speaker_name" name="speaker_name">
                        </div>
                        <div class="form-group">
                          <label>Speaker Affiliation</label>
                          <textarea class="form-control" name="speaker_affiliation"></textarea>
                        </div>
                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-add">Add</button>
                        </div>
                      </div>
                    </div>
                  </div>


                </form>

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
     $('#dashboard').addClass('active');

    $(document).on('click', '#btn-add-project', function() {
      $('#add-project-modal').modal('show');
    });
  });
</script>
@endsection