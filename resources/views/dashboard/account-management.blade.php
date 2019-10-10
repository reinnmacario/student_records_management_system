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
    <div class="modal fade" id="add-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    var accounts;
     $('#account-management').addClass('active');

    accounts = $("#table-accounts").DataTable({
        ajax: {
          url: "/",
          dataSrc: ''
        },
        responsive:true,
        "order": [[ 5, "desc" ]],
        columns: [
        { data: 'courier_id'},
        { data: null},
        { data: 'email' },
        { data: 'contact_number' },
        { data: 'created_at'},
        // { data: 'actions'},
        {data: null ,
                render : function ( data, type, row) {
                  if(data['status'] == 'active') {
                    return `<span class='switch switch-sm'> <input type='checkbox' class='switch change-status' name='${data['account_id']}' id='${data['account_id']}' data-id='${data['account_id']}' checked> <label for='${data['account_id']}'></label></span>`;
                  }
                  else {
                    return `<span class='switch switch-sm'><input type='checkbox' class='switch change-status' name='${data['account_id']}' id='${data['account_id']}' data-id='${data['account_id']}'><label for='${data['account_id']}'></label></span>`;
                  }
                }
              },
        { data: null,
          render: function ( data, type, row ) {
            return "<button type='button' class='btn btn-primary btn-sm btn-edit' data-id='"+data.courier_id+"' data-account='"+data.account_id+"'>Edit</button> <button class='btn btn-secondary btn-sm btn-delete' data-function='deleteCourier' data-id='"+data.courier_id+"' data-account='"+data.account_id+"'>Delete</button>";
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        { className: "acct-name", "targets": [1]},
        {
          "targets": 1,
          "data": 'courier_name',
          "render": function ( data, type, row ) {
        var mname = (data.mname !== null) ? data.mname : "";
        var profile_pic = (data.profile_pic !== null && data.profile_pic != "") ? '/storage/users/couriers/'+data.profile_pic : "{{asset('images/user.png')}}";
            return '<img class="table-user-pic" src="'+profile_pic+'">'+data.fname +' '+mname+' '+data.lname;
          } 
        }
        ]
    });

    $(document).on('click', '#btn-add-account', function() {
      $('#add-account-modal').modal('show');
    });
  });
</script>
@endsection