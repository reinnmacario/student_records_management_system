@extends('layouts.dashboard-master')
@section('title')
<title>Dashboard | Admin</title>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>
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

              @if(auth()->user()->role_id == 1)
              <button type="button" id="btn-add-project" class="btn btn-primary">Add Project</button>
              @endif
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-projects" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>eReserve No.</th>
                      <th>Event Title</th>
                      <th>Academic Year</th>
<!--                       <th>Semester</th> -->
                      <th>Date Submitted</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>eReserve No.</th>
                      <th>Event Title</th>
                      <th>Academic Year</th>
<!--                       <th>Semester</th> -->
                      <th>Date Submitted</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
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

                <form id="form-add-event">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>eReserve No.</label>
                            <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="ereserve_id" maxlength="10" required>
                          </div>
                          <div class="col-md-6">
                            <label>Start of Event Date</label>
                            <input type="date" class="form-control" id="date_start" name="date_start" required>
                          </div>
                        </div>
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" class="form-control" name="name">
                        </div>        
                        <div class="form-group">
                              <label>Academic Year</label>
                              <select type="select" id="select-academic-year" class="form-control" name="academic_year" required>
                              <option value="" selected disabled>Select Academic Year</option>
                              <option value="2018-2019">2018-2019</option>
                              <option value="2017-2018">2017-2018</option>
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Semester</label>
                              <select type="select" id="select-semester" class="form-control" name="semester" required>
                              <option value="" selected disabled>Select Semester</option>
                              <option value="1st Semester">1st Semester</option>
                              <option value="2nd Semester">2nd Semester</option>
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Event Classification</label>
                              <select type="select" id="select-event-classification" class="form-control" name="classification" required>
                              <option value="" selected disabled>Select Event Classification</option>
                              <option value="Seminar">Seminar</option>
                              <option value="Workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Academic Year</label>
                              <select type="select" id="select-academic-year" class="form-control" name="academic_year" required>
                              <option value="" selected disabled>Select Academic Year</option>
                              <option value="2018-2019">2018-2019</option>
                              <option value="2017-2018">2017-2018</option>
                            </select>
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
  var projects;
  var token = "{{csrf_token()}}";
  $(document).ready(function() {
     $('#dashboard').addClass('active');
    projects = $("#table-projects").DataTable({
        ajax: {
          url: "/events/all",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 5, "desc" ]],
        columns: [
        { data: 'id'},
        { data: 'ereserve_id' },
        { data: 'name' },
        { data: 'academic_year'},
        // { data: 'semester'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var status_name = "";
            if (data.status == 1) {
                status_name = "<span class='badge badge-primary'>Processing</span>";
              } 
            else  if (data.status == 2) {
              status_name = "<span class='badge badge-warning'>Submitted to SOCC</span>";
            }
            else if (data.status == 3) {
              status_name = "<span class='badge badge-warning'>Endorsed to OSA</span>";
            }

            else if (data.status == 4) {
              status_name = "<span class='badge badge-danger'>Rejected by SOCC</span>";
            }

            else if (data.status == 5) {
              status_name = "<span class='badge badge-danger'>Rejected by OSA</span>";
            }
            else if (data.status == 7) {
              status_name = "<span class='badge badge-success'>OSA Approved</span>";
            }
            return status_name;
            // return "<span class="badge badge-primary">Primary</span>";
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        ]
    });

    $(document).on('click', '#btn-add-project', function() {
      $('#add-project-modal').modal('show');
    });

    $(document).on('submit', '#form-add-event', function() {
       $.ajax({
            url: "events/store",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Added!");
                location.reload();
              }
              else {
                alert("Something went wrong");
              }
            }
          });
            return false;
    });

    $(document).on('click', '.btn-delete', function() {
      var confirm_alert = confirm("Are you sure you want to delete this event?");
      if (confirm_alert == true) {
       var id  = $(this).attr('data-id');
       $.ajax({
            url: "events/delete",
            type: "DELETE",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Deleted!");
                location.reload();
              }
            }

          });
      }
    });


  });
</script>
@endsection