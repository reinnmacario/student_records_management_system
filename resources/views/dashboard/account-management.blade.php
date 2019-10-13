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
            <li class="breadcrumb-item active">Account Management</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Account Management</div>
            <div class="card-body">

              <button type="button" id="btn-add-account" class="btn btn-primary">Add Account</button>
              <div class="table-responsive mt-3">
                <table class="table table-bordered dt-responsive" id="table-accounts" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Student No.</th>
                      <th>Role</th>
                      <th>Date Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="hidden">ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Student No.</th>
                      <th>Role</th>
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
    <div class="modal fade" id="add-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-home-tab">

                <form id="form-add-account">
                  <div class="container my-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select type="select" id="select-role" class="form-control" name="role_id" required>
                            </select>
                        </div>
                        <div class="form-group student-number-container hidden">
                          <label>Student Number</label>
                            <input type="text" class="form-control" id="student_number" name="student_number" required>
                        </div>
                        <div class="organization-container hidden">


                        </div>
                        <div class="form-row">
                          <div class="col-md-6">
                            <label>First name</label>
                            <input type="text" class="form-control" name="first_name" required>
                          </div>
                          <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                          <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                          </div>
                        </div>
                        <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                              <label>Password</label>
                              <input type="text" class="form-control" id="password" name="password" readonly>
                        </div>
                        <div class="form-group text-right mt-4">
                          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-confirm-add-account">Add</button>
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

  function getRoles() {
    $.ajax({
      url: "/users/get-all-roles",
      type: "GET",
      success: function(data) {
        var html = "<option value='' selected disabled>Select Role</option>";
        $.each(data, function(x,y) {
          html += '<option value="'+y.id+'">'+y.name+'</option>';
        });
        $('#select-role').html(html);
      }
    });
  }

  function getNewPassword() {
    $.ajax({
        type: 'GET',
        url: '/user/get-new-password',
        processData: false,
        success: function(data) {
        $('#password').val(data.password);
        }
      });
  }

  function appendOrganization() {
    var html = "";

    html += '<div class="form-group"> <label>Organization Name</label> <input type="text" class="form-control" name="organization_name" required> </div>';
    html += '<div class="form-group"> <label>Organization Type</label> <select type="select" id="select-org-type" class="form-control" name="organization_type" required>'+
    '<option value="" selected disabled>Select Organization Type</option>'+
    '<option value="TYPE A">TYPE A</option>'+
    '<option value="TYPE B">TYPE B</option>'+
    '</select></div>';
    html += '<div class="form-group"> <label>College</label> <select type="select" id="select-org-type" class="form-control" name="organization_college" required> <option value="" selected disabled>Select Organization Type</option> <option value="COLLEGE ONE">COLLEGE ONE</option> <option value="COLLEGE TWO">COLLEGE TWO</option> </select> </div>';
    $('.organization-container').html(html);              
  }
  $(document).ready(function() {
    getRoles();
    var accounts;
     $('#account-management').addClass('active');

    accounts = $("#table-accounts").DataTable({
        ajax: {
          url: "/users/get-all-users",
          dataSrc: ''
        },
        responsive:true,
        "order": [[ 6, "desc" ]],
        columns: [
        { data: 'id'},
        { data: 'first_name' },
        { data: 'last_name' },
        { data: 'email'},
        { data: 'student_number'},
        { data: 'role.name'},
        { data: 'created_at'},
        { data: null,
          render: function ( data, type, row ) {
            // <button type='button' class='btn btn-primary btn-sm btn-edit' data-id='"+data.id+"' data-account='"+data.id+"'>Edit</button> 
            return "<button class='btn btn-danger btn-sm btn-delete' data-id='"+data.id+"' data-account='"+data.id+"'>Delete</button>";
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        ]
    });

    $(document).on('click', '#btn-add-account', function() {
      $('#add-account-modal').modal('show');
      getNewPassword();
    });

    $(document).on('change', '#select-role', function() {
      var val = $(this).val();

      if(val != 3){
        $('.student-number-container').show();
      }
      else {
        $('.student-number-container').hide();
      }

      if(val != 1){
        $('.organization-container').html("");
      }
      else {
        appendOrganization();
        $('.organization-container').show();
      }

    });


    $(document).on('submit', '#form-add-account', function() {
       $.ajax({
            url: "register",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
              if (data.success === true) {
                alert("Account Successfully Added!");
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
      var confirm_alert = confirm("Are you sure you want to delete this account?");
      if (confirm_alert == true) {
       var id  = $(this).attr('data-id');
       $.ajax({
            url: "/user/delete/"+id,
            type: "DELETE",
            data: {
              _token: "{{csrf_token()}}"
            },
            success: function(data) {
              if (data.user) {
                alert("Account Successfully Deleted!");
                location.reload();
              }
            }

          });
      }
    });


  });
</script>
@endsection