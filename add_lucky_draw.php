<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Lucky Draw</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php 
  require 'db.php'; 
  include 'common_css.php'; 
  include 'nav_barr.php';
  include 'side_bar.php';
  extract($_REQUEST);

  ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Lucky Draw </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/logo.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Lucky Draw Game</h3>

                <p class="text-muted text-center">N/A</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Joined user</b> <a class="float-right">N/A</a>
                  </li>
                  <li class="list-group-item">
                    <b>Draw Fee </b> <a class="float-right">N/A</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date Result</b> <a class="float-right">N/A</a>
                  </li>
                </ul>

                <a href="activity_tracker.php?username=$profile" class="btn btn-primary btn-block"><b>Back</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-headerj">
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item">Settings </li>
                  <li class="nav-item"><?php
          if(isset($_COOKIE['draw_update'])){
          echo "".$_COOKIE['draw_update']."";
        }?></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="all_update.php" method="post">
                      <div class="form-group row">
                        
                        <label for="inputName" class="col-sm-1 col-form-label">Game Name</label>
                        <div class="col-sm-11">
                          <input type="text" class="form-control" name="lucky_draw_name" placeholder="Game Name">
                        </div>
                        
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Draw Prize</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control" id="inputEmail" name="prize"placeholder="Enter Draw Prize">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Fee Rs.</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control" id="inputEmail" name="draw_fee" placeholder="Fee">
                        </div>
                        
                        
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Allow User</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control" id="inputEmail" name="total_allow_user" placeholder="Total Allow User">
                        </div>
                        
                          <label for="inputEmail" class="col-sm-1 col-form-label">Result Date</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="inputEmail" name="date_result" placeholder="Result Date">
                          <input type="hidden" class="form-control" name="lucky_draw_details_add" value ="1">
                        </div>
                      </div>
                      
                      
                     <br/>
                     <br/>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 text-right">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'common_js.php';?>
</body>
</html>
