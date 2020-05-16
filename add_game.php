<?php include 'session.php';?>
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
              <li class="breadcrumb-item active">Add Game </li>
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

                <h3 class="profile-username text-center">Name</h3>

                <p class="text-muted text-center">Statistics</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Free Play</b> <a class="float-right">0</a>
                  </li>
                  <li class="list-group-item">
                    <b>Paid Play </b> <a class="float-right">0</a>
                  </li>
                  <li class="list-group-item">
                    <b>Join Fee</b> <a class="float-right">0</a>
                  </li>
                </ul>

                
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
                  
                  <li class="nav-item">Add Game </li>
                 

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="all_update.php" method="post">
                     
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Game Name</label>
                        <div class="col-sm-5">
                            
                          <input type="text" class="form-control" id="paid_game" name="paid_game" value = ""placeholder="Enter Game Name">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Game URL</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="game_url" name="game_url" value = ""placeholder="URL">
                        </div>
                         
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Image URL</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="game_icon" name="game_icon" value = "" placeholder="Game_url">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Join Fee</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control" id="join_fee" name="join_fee" value = ""placeholder="Join Fee">
                          <input type="hidden" class="form-control" name="add_game_data" value ="1">
                        </div>
                      </div>
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
