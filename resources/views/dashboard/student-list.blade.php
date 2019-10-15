@extends('layouts.dashboard-master')
@section('title')
<title>Student List | Student</title>
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
            <li class="breadcrumb-item active">Student List</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Student List</div>
            <div class="card-body">

              <button type="button" id="btn-add-student" class="btn btn-primary">Add Student</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-students" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Date Created</th>
                      <th>Actions</th>
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
    <div class="modal fade" id="add-student-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Participant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">

                <form id="form-add-student">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Student Id</label>
                            <input type="text" class="form-control" name="student_id" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="ereserve_id" required>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name">
                        </div>
                        <div class="form-group">
                            <label>Middle Initial</label>
                            <input type="text" class="form-control" maxlength="1" name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name">
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
     $('#student-list').addClass('active');
    projects = $("#table-students").DataTable({
        ajax: {
          url: "students",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 3, "desc" ]],
        columns: [
        { data: 'id'},
        { data: 'student_id' },
        { data: null,
            render: function ( data, type, row ) { 
            return data.first_name+" "+data.middle_initial+" "+data.last_name;
          } 
         },
        // { data: 'semester'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var html = "";
            html += '<button type="button" class="btn btn-primary">Edit</button> ';
            //html += '<button type="button" class="btn btn-danger">Delete</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        ]
    });

    $(document).on('click', '#btn-add-student', function() {
      $('#add-student-modal').modal('show');
    });

    $(document).on('submit', '#form-add-student', function() {
       $.ajax({
            url: "students/store",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Student Successfully Added!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }
          });
            return false;
    });

    // $(document).on('click', '.btn-delete', function() {
    //   var confirm_alert = confirm("Are you sure you want to delete this participant?");
    //   if (confirm_alert == true) {
    //    var id  = $(this).attr('data-id');
    //    $.ajax({
    //         url: "participant/delete",
    //         type: "DELETE",
    //         data: {
    //           id: id,
    //           _token: "{{csrf_token()}}"
    //         },
    //         success: function(data) {
    //           if (data.success === true) {
    //             alert("Participants Successfully Deleted!");
    //             location.reload();
    //           }
    //         }

    //       });
    //   }
    // });


  });
</script>
@endsection