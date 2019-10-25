@extends('layouts.dashboard-master')
@section('title')
<title>Speaker List | {{config('constants.templates.title_second')}}</title>
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
            <li class="breadcrumb-item active">Speaker List</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Speaker List</div>
            <div class="card-body">

              <button type="button" id="btn-add-speaker" class="btn btn-primary">Add Speaker</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-speakers" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Description</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Description</th>
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
            <h5 class="modal-title speaker-modal-title" id="exampleModalLongTitle">Add New Speaker</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">
                <form class="form-speaker">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                          </div>
                          <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                          </div>
                        </div>
                        <div class="form-group mt-3">
                          <label>Description</label>
                          <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-confirm">Confirm</button>
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
  var speakers;
  var token = "{{csrf_token()}}";
  $(document).ready(function() {
     $('#speaker-list').addClass('active');
    speakers = $("#table-speakers").DataTable({
        ajax: {
          url: "/speakers/index",
          type: "GET",
          dataSrc: "", 

        },
        responsive:true,
        "order": [[ 4, "desc" ]],
        columns: [
        { data: 'id'},
        { data: 'first_name' },
        { data: 'last_name' },
        { data: 'description'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) { 
            var html = "";
            html += '<button type="button" class="btn btn-primary btn-edit">Edit</button> ';
            //html += '<button type="button" class="btn btn-danger btn-delete">Delete</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        {  targets: [5], orderable: false}
        ]
    });

    $(document).on('click', '#btn-add-speaker', function() {
      $('.speaker-modal-title').html('Add New Speaker');
      $('.form-speaker').attr('id', 'form-add-speaker');
      $('#add-speaker-modal').modal('show');
    });

    $(document).on('submit', '#form-add-speaker', function(e) {
      e.preventDefault();
       $.ajax({
            url: "speakers/store",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Speaker Successfully Added!");
                location.reload();
              }
              else {
                alert("Something went wrong");
              }
            }
          });
            return false;
    });

        $(document).on('submit', '#form-edit-speaker', function(e) {
          e.preventDefault();
         $.ajax({
              url: "speakers/update",
              type: "POST",
              data: $(this).serialize()+ '&id='+$('.btn-confirm').attr('data-id'),
              success: function(data) {
                if (data.success === true) {
                  alert("Speaker Successfully Updated!");
                  location.reload();
                }
                else {
                  alert(data.error);
                }
              }
            });
            return false;
    });


    $(document).on('click', '.btn-edit', function() {
      var data = speakers.row( $(this).parents('tr') ).data();
      $('.form-speaker').attr('id', 'form-edit-speaker');
      $('.speaker-modal-title').html('Edit Speaker');
      $('#first_name').val(data.first_name);
      $('#last_name').val(data.last_name);
      $('.btn-confirm').attr('data-id', data.id);
      $('#description').val(data.description);
      $('#add-speaker-modal').modal('show');
    });


    $(document).on('click', '.btn-delete', function() {
      var confirm_alert = confirm("Are you sure you want to delete this speaker?");
      if (confirm_alert == true) {
       var id  = $(this).attr('data-id');
       $.ajax({
            url: "speaker/delete",
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