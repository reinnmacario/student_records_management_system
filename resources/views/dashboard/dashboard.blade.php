@extends('layouts.dashboard-master')
@section('title')
<title>Dashboard | Admin</title>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>


.select1-container, .select2-container, #select-student, #select-speaker {
  width: 100%!important;
  }

.select1-container .select1-selection--single, .select2-container .select2-selection--single{
    height:34px !important;

}
.select1-container--default .select1-selection--single, .select2-container--default .select2-selection--single{
     border: 1px solid #ccc !important; 
     border-radius: 0px !important; 
}

</style>
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
        <nav class="mt-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="true">Events/Projects</a>
              <a class="nav-item nav-link" id="nav-students-tab" data-toggle="tab" href="#nav-students" role="tab" aria-controls="nav-students" aria-selected="true">Student Participants</a>
              <a class="nav-item nav-link" id="nav-speakers-tab" data-toggle="tab" href="#nav-speakers" role="tab" aria-controls="nav-speakers" aria-selected="false">Event Speakers</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
          <button type="button" id="btn-add-project" class="btn btn-primary my-3">Add Project</button>
            <div class="tab-events">
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
          <div class="tab-pane fade" id="nav-students" role="tabpanel" aria-labelledby="nav-students-tab">
              <button type="button" id="btn-add-participant" class="btn btn-primary my-3">Add Event Participant</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-participants" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Event Title</th>
                      <th>Student Name</th>
                      <th>Involvement</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Event Title</th>
                      <th>Student Name</th>
                      <th>Involvement</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="tab-pane fade" id="nav-speakers" role="tabpanel" aria-labelledby="nav-speakers-tab">

            <button type="button" id="btn-add-speaker" class="btn btn-primary my-3">Add Event Speaker</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-speakers" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Event Name</th>
                      <th>Speaker Name</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>Event Name</th>
                      <th>Speaker Name</th>
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
              @else
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
              @endif
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
                        </div>                        <div class="form-group text-right mt-4">
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



@if(auth()->user()->role_id == 1)
   <!-- Add Participant Modal -->
    <div class="modal fade" id="add-participant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

                <form id="form-add-participant">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Event</label>
                            <select type="select" class="form-control select2 select-event" data-type="1" name="event" required>
                              <option value="" selected disabled>Select Event</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Student</label>
                            <select type="select" id="select-student" class="form-control select2 select-student" name="student" required>
                              <option value="" selected disabled>Select Student</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Involvement</label>
                            <select type="select" id="select-involvement" class="form-control" name="involvement" required>
                              <option value="" selected disabled>Select Involvement</option>
                              <option value="Participant">Participant</option>
                              <option value="Organizer">Organizer</option>
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

      <!-- Event Speaker Modal -->
    <div class="modal fade" id="add-speaker-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Speaker</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">
                <form id="form-add-event-speaker">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                            <div class="form-group">
                              <label>Event</label>
                              <select type="select" class="form-control select2 select-event" data-type="2" name="event" required>
                                <option value="" selected disabled>Select Event</option>
                              </select>
                            </div>
                            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                              <label>Speaker</label>
                              <select type="select" id="select-speaker" class="form-control select2 select-speaker" name="speaker" required>
                                <option value="" selected disabled>Select Speaker</option>
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
@endif

@endsection
@section('scripts')
<script>  
  var projects;
  var token = "{{csrf_token()}}";
   
  $(document).ready(function() {
     $('.select2').each(function () {
            $(this).select2({
              dropdownParent: $(this).parent()
          });
      });

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


 // Student Participants scripts
 @if(auth()->user()->role_id == 1) 
  function getAllEvents() {
    $.ajax({
            url: "events/get-all-events",
            type: "GET",
            success: function(data) {
              var html = '<option value="" selected disabled>Select Event</option>';
              $.each(data, function(x,y) {
                  html += '<option value="'+y.id+'">'+y.name+'</option>';
              });
              $('.select-event').html(html);
            }
          });

  }

  function getAllStudents() {
    $.ajax({
            url: "students",
            type: "GET",
            success: function(data) {
              var html = '<option value="" selected disabled>Select Student</option>';
              $.each(data, function(x,y) {
                  html += '<option value="'+y.id+'">'+y.first_name+ " "+y.middle_initial+" "+y.last_name+'</option>';
              });
              $('#select-student').html(html);
            }
          });
  }

  function getAllSpeakers() {
     $.ajax({
            url: "events/get-all-speakers",
            type: "POST",
            data:{
              _token: "{{csrf_token()}}",
            },
            success: function(data) {
              var html = '<option value="" selected disabled>Select Speaker</option>';
              $.each(data, function(x,y) {
                  html += '<option value="'+y.id+'">'+y.first_name+" "+y.last_name+'</option>';
              });

              $('.select-speaker').html(html);

              // if(type==1) {
              //   $('.select-student').html(html);
              // } 
              // else if(type==2) {
              //   $('.select-speaker').html(html);
              // }
            }
      });
  }

  var participants, projects;
  var token = "{{csrf_token()}}";
    getAllEvents();
    getAllStudents();
    getAllSpeakers();
    participants = $("#table-participants").DataTable({
        ajax: {
          url: "students/get-event-participants",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 4, "desc" ]],
        columns: [
        { data: 'event_id'},
        { data: 'name' },
        { data: null,
            render: function ( data, type, row ) { 
            return data.first_name+" "+data.middle_initial+" "+data.last_name;
          } 
         },
        // { data: 'semester'},
        { data: 'involvement'},
        { data: 'updated_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var html = "";
            //html += '<button type="button" class="btn btn-primary">Edit</button> ';
            html += '<button type="button" class="btn btn-danger btn-delete-participant" data-event="'+data.event_id+'" data-student="'+data.student_id+'">Remove</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        {  targets: [5], orderable: false}
        ]
    });


    $(document).on('click', '#btn-add-participant', function() {
      $('#add-participant-modal').modal('show');
    });

    $(document).on('submit', '#form-add-participant', function() {
       $.ajax({
            url: "students/events/add",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Participant Successfully Added!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }
          });
            return false;
    });

    $(document).on('click', '.btn-delete-participant', function() {
      var confirm_alert = confirm("Are you sure you want to delete this participant?");
      if (confirm_alert == true) {
       var event_id  = $(this).attr('data-event');
       var student_id = $(this).attr('data-student');
       $.ajax({
            url: "events/participant/delete",
            type: "DELETE",
            data: {
              event_id: event_id,
              student_id: student_id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Participant Successfully Deleted!");
                location.reload();
              }
            }

          });
      }
    });



    // Event  Speaker Scripts
      projects = $("#table-speakers").DataTable({
        ajax: {
          url: "/events/get-all-event-speakers",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 3, "desc" ]],
        columns: [
        { data: 'event_id'},
        { data: 'name' },
         { data: null,
            render: function ( data, type, row ) { 
            return data.first_name+" "+data.last_name;
          } 
         },
        // { data: 'semester'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var html = "";
            //html += '<button type="button" class="btn btn-primary">Edit</button> ';
            html += '<button type="button" class="btn btn-danger btn-delete-event-speaker" data-event="'+data.event_id+'" data-speaker="'+data.speaker_id+'">Remove</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        {  targets: [4], orderable: false}
        ]
    });

    $(document).on('click', '#btn-add-speaker', function() {
      $('#add-speaker-modal').modal('show');
    });

    // $(document).on('change', '.select-event', function() {
    //   var type = $(this).attr('data-type');
       
    // });

    $(document).on('submit', '#form-add-event-speaker', function() {
       $.ajax({
            url: "events/speakers/add",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Event Speaker Successfully Added!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }
          });
            return false;
    });

    $(document).on('click', '.btn-delete-event-speaker', function() {
      var confirm_alert = confirm("Are you sure you want to delete this event speaker?");
      if (confirm_alert == true) {
       var event_id  = $(this).attr('data-event');
       var speaker_id  = $(this).attr('data-speaker');
       $.ajax({
            url: "events/speaker/delete",
            type: "DELETE",
            data: {
              event_id: event_id,
              speaker_id: speaker_id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Speaker Successfully Deleted!");
                location.reload();
              }
              else {
                alert(data.message);
              }
            }

          });
      }
    });
 @endif
  });
</script>
@endsection