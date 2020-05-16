<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Game</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php 
  require 'db.php'; 
  include 'common_css.php'; 
  include 'nav_barr.php';
  include 'side_bar.php';
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
              <li class="breadcrumb-item active">Send Notification </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item">Send Notification </li>
                 

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="tab-pane" id="settings">
                    <form  action="../spin/db_operations.php" method="post">
                     
                      <div class="form-group row">
                        <label for="all" class="col-sm-1 col-form-label">Title</label>
                        
                        <div class="col-sm-5">
                            <input type="hidden" class="form-control" id="send_notification" name="send_notifications" value = "1">
                            <input type="hidden" class="form-control" id="send_notification" name="users" value ="all">
                          <input type="text" class="form-control" id="title" name="title" value = ""placeholder="Title">
                        </div>
                       
                      </div>
                      <div class="form-group row">
                    <label for="inputEmail" class="col-sm-1 col-form-label">Message</label>
                        <div class="col-sm-5">
                          <textarea type="text" class="form-control" id="game_url" name="message"></textarea>
                        </div>
                         
                      </div>
                     
                        <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 text-right">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                        <?php
          if(isset($_COOKIE['send_notification'])){
          echo "".$_COOKIE['send_notification']."";
        }?></li>
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
  
<?php include 'footer.php';?>
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
