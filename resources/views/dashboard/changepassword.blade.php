@extends('layouts.dashboard-master')
@section('title')
<title>Dashboard | Admin</title>
@endsection

@section('styles')

@endsection
@section('content')
     <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>

<div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card dashboard-card mt-4 mb-4">
              <div class="card-body">
                <form action="" method="post">
                  <div class="row">
                  <div class="col-md-3"></div>
                <div class="col-md-5 mt-3">
                  <div id="message" class="hidden"></div>
                  <div class="form-group mt-1">
                    <label class="standard-field-label">Current Password <span class="required">*</span></label>
                      <input type="password" class="form-control standard-form-field req" name="current_password" id="current-password">
                  </div> 
                  <div class="form-group">
                    <label class="standard-field-label">New Password <span class="required">*</span></label>
                      <input type="password" class="form-control standard-form-field req" name="new_password" id="new-password">
                  </div>
                  <div class="form-group">
                    <label class="standard-field-label">Confirm New Password <span class="required">*</span></label>
                      <input type="password" class="form-control standard-form-field req" name="confirm_new_password" id="confirm-new-password">
                  </div> 
                  <button type="button" class="btn btn-success btn-change-password">Confirm</button>
                </div>
                <div class="col-md-3">
                  
                </div>
              </div>
              </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection

