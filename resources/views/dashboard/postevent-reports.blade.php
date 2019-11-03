@extends('layouts.dashboard-master')
@section('title')
<title>Post-EVent Reports | SRMS</title>
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
            <li class="breadcrumb-item active">Post Event Reports</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Post Event Reports</div>
            <div class="card-body">
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-reports" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>eReserve Number</th>
                      <th>Event Name</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>eReserve Number</th>
                      <th>Event Name</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
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
    <div class="modal fade" id="eval-report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Evaluation Reports</h5>
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
                         <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Respondent Demographic(F.)</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Assessment of Event(G.)</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">SAAF</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Evaluation Forms(Answered)</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Liquidation Report</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Short write-up</label>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="eval-check">
                            <label class="form-check-label">Pictures of Event with Description</label>
                          </div>
                          <div class="form-group mt-4">
                            <textarea class="form-control" id="notes" name="notes" placeholder="Remarks:"></textarea>
                          </div>
                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-danger btn-socc-reject">Reject</button>
                          <button type="button" class="btn btn-success btn-socc-endorse">Endorse</button>
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


 <!-- Edit Project Modal -->
    <div class="modal fade" id="update-project-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">

                <form id="form-edit-event">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>eReserve No.</label>
                            <input type="text" class="form-control" id="edit_ereserve_id" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="ereserve_id" maxlength="10" required>
                          </div>
                          <div class="col-md-6">
                            <label>Start of Event Date</label>
                            <input type="date" class="form-control" id="edit_date_start" name="date_start" required>
                          </div>
                        </div>
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" id="edit_event_name" class="form-control" name="name">
                        </div>        
                        <div class="form-group">
                              <label>Academic Year</label>
                              <select type="select" id="edit_academic_year" class="form-control" name="academic_year" required>
                              <option value="" selected disabled>Select Academic Year</option>
                              <option value="2018-2019">2018-2019</option>
                              <option value="2017-2018">2017-2018</option>
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Semester</label>
                              <select type="select" id="edit_semester" class="form-control" name="semester" required>
                              <option value="" selected disabled>Select Semester</option>
                              <option value="1st Semester">1st Semester</option>
                              <option value="2nd Semester">2nd Semester</option>
                            </select>
                        </div>
                        <div class="form-group">
                              <label>Event Classification</label>
                              <select type="select" id="edit_classification" class="form-control" name="classification" required>
                              <option value="" selected disabled>Select Event Classification</option>
                              <option value="Seminar">Seminar</option>
                              <option value="Workshop">Workshop</option>
                            </select>
                        </div>   

                        <div class="form-group">
                            <div class="form-group mt-4">
                            <label>Remarks:</label>
                            <textarea class="form-control" id="edit_notes" name="notes" placeholder="Remarks:" readonly></textarea>
                          </div>
                        </div>   

                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-update-event" class="btn btn-success">Update</button>
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



 <!-- Modal -->
    <div class="modal fade" id="project-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Project Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
              <a class="nav-item nav-link" id="nav-stud-participants-tab" data-toggle="tab" href="#nav-stud-participants" role="tab" aria-controls="nav-stud-participants" aria-selected="false">Student Participants</a>
              <a class="nav-item nav-link" id="nav-speakers-tab" data-toggle="tab" href="#nav-speakers" role="tab" aria-controls="nav-speakers" aria-selected="false">Speakers</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
              <form id="form-add-event">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>eReserve No.</label>
                            <input type="text" class="form-control" id="ereserve_id" readonly="">
                          </div>
                          <div class="col-md-6">
                            <label>Start of Event Date</label>
                            <input type="text" class="form-control" id="date_start" name="date_start" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                            <label>Event Title</label>
                            <input type="text" class="form-control" id="event_name" readonly>
                        </div>        
                        <div class="form-group">
                              <label>Academic Year</label>
                              <input type="text" class="form-control" id="academic_year" name="academic_year" readonly>
                        </div>
                        <div class="form-group">
                              <label>Semester</label>
                              <input type="text" class="form-control" id="semester" name="semester" readonly>
                        </div>
                        <div class="form-group">
                              <label>Event Classification</label>
                              <input type="text" class="form-control" id="classification" name="classification" readonly>
                        </div>
                        <div class="form-group">
                              <label>Date Submitted</label>
                              <input type="text" class="form-control" id="date_submitted" name="date_submitted" readonly>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-success btn-view-checklist hidden">View Checklist</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-stud-participants" role="tabpanel" aria-labelledby="nav-stud-participants-tab">
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-stud-participants" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Involvement</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Involvement</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-speakers" role="tabpanel" aria-labelledby="nav-speakers-tab">
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-speakers" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Speaker</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Speaker</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
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

  var reports;
  var stud_participants, speakers;
  var current_event_id = null;
  $(document).ready(function() {
     $('#post-event-reports').addClass('active');
      reports = $("#table-reports").DataTable({
          ajax: {
            url: "/events/get-post-event-reports",
            type: "GET",
            dataSrc: "", 

          },
          responsive:true,
          "order": [[3, "desc" ]],
          columns: [
          { data: 'id'},
          { data: 'ereserve_id' },
          { data: 'name' },
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
          },
          { data: null,
            render: function ( data, type, row ) { 
              var html = "";
              html += '<button type="button" class="btn btn-success btn-see-report" data-status="'+data.status+'" data-id="'+data.id+'">See Report</button> ';
              @if(auth()->user()->role_id == 1)
              if (data.status == 4 || data.status == 5) {
                html += '<button type="button" class="btn btn-info btn-edit-project" data-status="'+data.status+'" data-id="'+data.id+'">Edit</button> ';
              }

              @endif
              @if(auth()->user()->role_id == 3)
              if (data.status == 3) {
                html += '<button type="button" class="btn btn-success btn-approve" data-id="'+data.id+'">Approve</button> ';
                html += '<button type="button" class="btn btn-danger btn-reject" data-id="'+data.id+'">Reject</button> ';
              }


              if (data.status == 7) {
                html += '<button type="button" class="btn btn-dark btn-archive" data-id="'+data.id+'">Archive</button> ';
              } 

              @endif
              return html;
            } 
          }
          ],
          columnDefs: [
          { className: "hidden", "targets": [0]},
          {  targets: [5], orderable: false}
          ]
      });
      
      $(document).on('click', '.btn-export', function() {
        var orgid = $(this).attr('data-orgid');
        var email = $(this).attr('data-email');
        // var win = window.open('students/'+orgid+'/generate-report?mail=true&recipient='+email, '_blank');
        var win = window.open('students/'+orgid+'/generate-report?export=true', '_blank');
      });


      $('#project-info-modal').on('hidden.bs.modal', function () {
        stud_participants.destroy();
        speakers.destroy();
      });
  
  
      $(document).on('click', '.btn-see-report', function() {
        var id  = $(this).attr('data-id');
        $('#project-info-modal').modal('show');


        stud_participants = $("#table-stud-participants").DataTable({
          ajax: {
            url: "/events/get-post-event-students",
            type: "POST",
            dataSrc: "", 
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            }

          },
          responsive:true,
          "order": [[0, "desc" ]],
          columns: [
          { data: 'student_id' },
          { data: null,
            render: function ( data, type, row ) { 
            return data.first_name+" "+data.middle_initial+" "+data.last_name;
            } 
          },
          { data: 'involvement'},
         
          ]
      });

       speakers = $("#table-speakers").DataTable({
          ajax: {
            url: "/events/get-post-event-speakers",
            type: "POST",
            dataSrc: "", 
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            }

          },
          responsive:true,
          "order": [[0, "desc" ]],
          columns: [
          { data: null,
            render: function ( data, type, row ) { 
            return data.first_name+" "+data.last_name;
            } 
          }
          ]
      });


        @if(auth()->user()->role_id != 1)
        var status = $(this).attr('data-status');
        if (status == 2) {
          $('.btn-view-checklist').attr('data-id', id);
          $('.btn-view-checklist').show();
        } else {
          $('.btn-view-checklist').hide();
        }
        @endif
        $.ajax({
            url: "/events/get-specific-event",
            type: "POST",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              $('#ereserve_id').val(data.ereserve_id);
              $('#event_name').val(data.name);
              $('#date_start').val(data.date_start);
              $('#academic_year').val(data.academic_year);
              $('#semester').val(data.semester);
              $('#classification').val(data.classification);
              $('#date_submitted').val(data.updated_at);

            }

          });
      });

      $(document).on('click', '.btn-edit-project', function() {
        var id = $(this).attr('data-id');
        $('#btn-update-event').attr('data-id', id);
      $('#update-project-modal').modal('show');

      $.ajax({
            url: "/events/get-specific-event",
            type: "POST",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              $('#edit_ereserve_id').val(data.ereserve_id);
              $('#edit_event_name').val(data.name);
              $('#edit_date_start').val(data.date_start);
              $('#edit_academic_year').val(data.academic_year);
              $('#edit_semester').val(data.semester);
              $('#edit_classification').val(data.classification);
              $('#edit_date_submitted').val(data.updated_at);
              $('#edit_notes').val(data.notes);

            }

          });

      });


      $(document).on('submit', '#form-edit-event', function() {
       $.ajax({
            url: "/events/update",
            type: "POST",
            data: $(this).serialize()+"&status="+2+"&id="+$('#btn-update-event').attr('data-id'),
            success: function(data) {
              if (data.success === true) {
                alert("Participant Successfully Updated!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }
          });
            return false;
    });


      $(document).on('click', '.btn-view-checklist', function() {
        var id  = $(this).attr('data-id')
        if (current_event_id == null) {
          current_event_id = id;
        }

        if (current_event_id != id) {
          $('.eval-check').prop('checked', false);
          $('#notes').val('');
          current_event_id = id;
        }
        $('#project-info-modal').modal('hide');
        $('#eval-report-modal').modal('show');
        $('.btn-socc-endorse').attr('data-id', id);
        $('.btn-socc-reject').attr('data-id', id);
      });

      $(document).on('click', '.btn-socc-endorse', function() {
        var id = $(this).attr('data-id');
        var ctr = 0;
        $.each($('.eval-check'), function() {
          if ($(this).prop('checked') == false) {
            ctr++;
          }
        });

        if (ctr != 0) {
          alert('Requirements is not complete. Event cannot be endorsed to OSA.');
          return  false;

        }
        var confirm_alert = confirm("Are you sure you want to endorse this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/approve",
            type: "POST",
            data: {
              id: id,
              notes: $('#notes').val(),
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Endorsed to OSA!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }

          });
        }
      });

      $(document).on('click', '.btn-socc-reject', function() {
        var id = $(this).attr('data-id');
        var notes = $('#notes').val();
        var confirm_alert = confirm("Are you sure you want to reject this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/reject",
            type: "POST",
            data: {
              id: id,
              notes: notes,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Rejected!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }

          });
        }
      });


      $(document).on('click', '.btn-archive', function() {
        var id = $(this).attr('data-id');
        var confirm_alert = confirm("Are you sure you want to archive this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/archive",
            type: "POST",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Archived!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }

          });
        }
      });

      $(document).on('click', '.btn-approve', function() {
        var id = $(this).attr('data-id');
        var notes = $('#notes').val();
        var confirm_alert = confirm("Are you sure you want to approve this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/approve",
            type: "POST",
            data: {
              id: id,
              notes: notes,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Approved!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }

          });
        }
      });

      $(document).on('click', '.btn-reject', function() {
        var id = $(this).attr('data-id');
        var confirm_alert = confirm("Are you sure you want to reject this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/reject",
            type: "POST",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Event Successfully Rejected!");
                location.reload();
              }
              else {
                alert(data.error);
              }
            }

          });
        }
      });




  });
 
</script>
@endsection