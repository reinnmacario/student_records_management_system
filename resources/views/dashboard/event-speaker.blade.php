@extends('layouts.dashboard-master')
@section('title')
<title>Event Speaker | Student Record Management System</title>
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
            <li class="breadcrumb-item active">Event Speaker</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Event Speakers</div>
            <div class="card-body">

              <button type="button" id="btn-add-speaker" class="btn btn-primary">Add Event Speaker</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-participants" width="100%" cellspacing="0">
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

        </div>
        <!-- /.container-fluid -->
      </div>

      <!-- Modal -->
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
                              <select type="select" id="select-event" class="form-control" name="event" required>
                                <option value="" selected disabled>Select Event</option>
                              </select>
                            </div>
                            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                              <label>Speaker</label>
                              <select type="select" id="select-speaker" class="form-control" name="speaker" required>
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


@endsection
@section('scripts')
<script>  

  function getAllEvents() {
    $.ajax({
            url: "events/get-all-events",
            type: "GET",
            success: function(data) {
              var html = '<option value="" selected disabled>Select Event</option>';
              $.each(data, function(x,y) {
                  html += '<option value="'+y.id+'">'+y.name+'</option>';
              });
              $('#select-event').html(html);
            }
          });

  }

  var projects;
  var token = "{{csrf_token()}}";
  $(document).ready(function() {
    getAllEvents();
    
     $('#event-speakers').addClass('active');
      projects = $("#table-participants").DataTable({
        ajax: {
          url: "/events/get-all-event-speakers",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 4, "desc" ]],
        columns: [
        { data: 'id'},
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
            //html += '<button type="button" class="btn btn-danger">Delete</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        ]
    });

    $(document).on('click', '#btn-add-speaker', function() {
      $('#add-speaker-modal').modal('show');
    });

    $(document).on('change', '#select-event', function() {
        $.ajax({
            url: "events/get-all-speakers",
            type: "POST",
            data:{
              _token: "{{csrf_token()}}",
              id: $('#select-event').val()
            },
            success: function(data) {
              var html = '<option value="" selected disabled>Select Speaker</option>';
              $.each(data, function(x,y) {
                  html += '<option value="'+y.id+'">'+y.first_name+" "+y.last_name+'</option>';
              });
              $('#select-speaker').html(html);
            }
      });
    });

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

    $(document).on('click', '.btn-delete', function() {
      var confirm_alert = confirm("Are you sure you want to delete this event speaker?");
      if (confirm_alert == true) {
       var id  = $(this).attr('data-id');
       $.ajax({
            url: "events/speaker/delete",
            type: "DELETE",
            data: {
              id: id,
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.success === true) {
                alert("Speaker Successfully Deleted!");
                location.reload();
              }
            }

          });
      }
    });


  });
</script>
@endsection