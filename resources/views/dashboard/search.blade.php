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
@endsection
@section('scripts')
<script>  
  var projects;
  var token = "{{csrf_token()}}";
  $(document).ready(function() {
     $('#search').addClass('active');
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
            // html += '<button type="button" class="btn btn-success btn-view-events" data-id="'+data.id+'">View Events</button> ';
            html += ' <button type="button" class="btn btn-info btn-export" data-id="'+data.id+'">Export</button> ';
            //html += '<button type="button" class="btn btn-danger">Delete</button>';
            return html;
          } 
        }
        ],
        columnDefs: [
        { className: "hidden", "targets": [0]},
        ]
    });


 $(document).on('click', '.btn-export', function() {
    var student_id = $(this).attr('data-id');
    // var win = window.open('students/'+student_id+'/generate-report?mail=true&recipient='+email, '_blank');
    var win = window.open('students/'+student_id+'/generate-report?export=true', '_blank');
  });


  });
</script>
@endsection