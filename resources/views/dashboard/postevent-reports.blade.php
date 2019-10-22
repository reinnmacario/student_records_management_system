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
                      @if(auth()->user()->role_id != 1)
                      <th>Actions</th>
                      @endif
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>eReserve Number</th>
                      <th>Event Name</th>
                      <th>Date Submitted</th>
                      <th>Status</th>
                      @if(auth()->user()->role_id != 1)
                      <th>Actions</th>
                      @endif
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

@endsection
@section('scripts')
<script>  

  var reports;
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
          }
          @if(auth()->user()->role_id != 1),
          { data: null,
            render: function ( data, type, row ) { 
              var html = "";
              @if(auth()->user()->role_id == 2)
              if (data.status == 2) {
                html += '<button type="button" class="btn btn-success btn-see-report" data-id="'+data.id+'">See Report</button> ';
              }
              @endif

              @if(auth()->user()->role_id == 3)
              if (data.status == 3) {
                html += '<button type="button" class="btn btn-success btn-approve" data-id="'+data.id+'">Approve</button> ';
                html += '<button type="button" class="btn btn-danger btn-reject" data-id="'+data.id+'">Reject</button> ';
              }

              else if(data.status == 7){
                html += '<button type="button" class="btn btn-primary btn-export" data-orgid="'+data.organization_id+'"  data-email="'+data.organization.user.email+'">Export Report</button>';
              }
              @endif
              return html;
            } 
          }
          @endif
          ],
          columnDefs: [
          { className: "hidden", "targets": [0]},
          ]
      });
      
      $(document).on('click', '.btn-export', function() {
        var orgid = $(this).attr('data-orgid');
        var email = $(this).attr('data-email');
        // var win = window.open('students/'+orgid+'/generate-report?mail=true&recipient='+email, '_blank');
        var win = window.open('students/'+orgid+'/generate-report?export=true', '_blank');
      });


      $(document).on('click', '.btn-see-report', function() {
        var id  = $(this).attr('data-id');
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


      $(document).on('click', '.btn-approve', function() {
        var id = $(this).attr('data-id');
        var confirm_alert = confirm("Are you sure you want to approve this event?");
        if (confirm_alert == true) {
          $.ajax({
            url: "/events/approve",
            type: "POST",
            data: {
              id: id,
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