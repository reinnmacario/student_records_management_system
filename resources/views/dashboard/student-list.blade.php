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
                      <th>College</th>
                      <th>Course</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>College</th>
                      <th>Course</th>
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
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Initial</label>
                            <input type="text" class="form-control" maxlength="2" name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group">
                              <label>College</label>
                              <select type="select" id="select-college" class="form-control select-college" name="college" required>
                              <option value="" selected disabled>Select College</option>
                              @foreach($colleges as $college)
                                <option value="{{$college->college_name}}" data-id="{{$college->id}}">{{$college->college_name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Course</label>
                              <select type="select" id="select-course" class="form-control select-course" name="course" required>
                              <option value="" selected disabled>Select Course</option>

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


    <!-- EDit Modal -->
    <div class="modal fade" id="edit-student-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Participant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">

                <form id="form-edit-student">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Student Id</label>
                            <input type="text" class="form-control" id="edit_student_id" name="student_id" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="ereserve_id" required>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label>Middle Initial</label>
                            <input type="text" class="form-control" id="edit_mi" maxlength="2" name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                              <label>College</label>
                              <select type="select" id="select-college" class="form-control edit_college select-college" name="college" required>
                              <option value="" selected disabled>Select College</option>
                              @foreach($colleges as $college)
                                <option value="{{$college->college_name}}" data-id="{{$college->id}}">{{$college->college_name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Course</label>
                              <select type="select" id="select-course" class="form-control edit_course select-course" name="course" required>
                              <option value="" selected disabled>Select Course</option>
                            </select>
                        </div>
                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-confirmedit">Update</button>
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
        {data: 'college'},
        {data: 'course'},
        // { data: 'semester'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var html = "";
            html += '<button type="button" class="btn btn-primary btn-edit-student" data-id="'+data.id+'">Edit</button> ';
            //html += '<button type="button" class="btn btn-danger">Delete</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        {  targets: [6], orderable: false}
        ]
    });

    $(document).on('click', '#btn-add-student', function() {
      $('#add-student-modal').modal('show');
    });


    $(document).on('click', '.btn-edit-student', function() {
      $('#edit-student-modal').modal('show');
      var id  = $(this).attr('data-id');
      $('.btn-confirmedit').attr('data-id', id);
      $('.edit_course').html('<option value="" selected disabled>Select Course</option>');
      $.ajax({
            url: "students/get-specific-info",
            type: "POST",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              $('#edit_student_id').val(data.student_id);
              $('#edit_first_name').val(data.student_id);
              $('#edit_mi').val(data.student_id);
              $('#edit_last_name').val(data.student_id);
              $('.edit_college').val(data.college);
              $('.edit_course').html("<option value='"+data.course+"'>"+data.course+"</option>");
            }
          });

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


    $(document).on('submit', '#form-edit-student', function() {
      var id =  $('.btn-confirmedit').attr('data-id');
       $.ajax({
            url: "students/update",
            type: "POST",
            data: $(this).serialize()+"&id="+id,
            success: function(data) {
              if (data.success === true) {
                alert("Student Successfully Updated!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }
          });
          return false;
    });


    $(document).on('change', '.select-college', function() {
      $('.select-course').html('<option value="" selected disabled>Select Course</option>');
      var college_id = $('option:selected', this).attr('data-id');
       $.ajax({
            url: "students/get-college-course",
            type: "POST",
            data: {
              college_id : college_id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              var html = '<option value="" selected disabled>Select Course</option>';
              if(data.length > 0) {
                $.each(data, function(x,y) {
                  html += '<option value="'+y.course_name+'">'+y.course_name+'</option>';
                });

                $('.select-course').html(html);
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