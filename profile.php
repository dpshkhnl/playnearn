<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profile</title>
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
    if(@$username) {
    $str =  "SELECT * FROM users WHERE username = '$username'";
    $query = mysqli_query($link,$str);
    $row = mysqli_fetch_assoc($query);
    $profile = $row['username'];
    // echo $row['username'];
    }
  ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
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

                <h3 class="profile-username text-center"><?php echo $row['username']?></h3>

                <p class="text-muted text-center"><?php echo $row['email']?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Points</b> <a class="float-right"><?php echo $row['points']?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Company Name </b> <a class="float-right"><?php echo $row['company_name']?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Last Update</b> <a class="float-right"><?php echo $row['last_update']?></a>
                  </li>
                </ul>

                <a href="activity_tracker.php?username=$profile" class="btn btn-primary btn-block"><b>Check Aciticty</b></a>
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
                  
                  <li class="nav-item">Settings</li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  
                  <div class="tab-pane" id="settings">
              
                    <form class="form-horizontal" action="all_update.php" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="inputName" value = "<?php echo $row['name']?>"placeholder="Name">
                          <input type="hidden" class="form-control" name="id" id="inputName" value = "<?php echo $row['id']?>"placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email"  class="form-control" id="inputEmail" value = "<?php echo $row['email']?>"placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">UPI NAME</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail" name="upi_name"value = "<?php echo $row['upi_name']?>"placeholder="UPI NAME">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">UPI ID</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail" name="upi_id" value = "<?php echo $row['upi_id']?>"placeholder="UPI ID">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" name="password" placeholder="Change Password">
                          <input type="hidden" class="form-control" id="inputName2" value="1" name="admin_update">
                        </div>
                      </div>
                      
                     
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
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
      
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item">Admob</li>
                </ul>
              </div>
               <?php  $str =  "SELECT * FROM admob";
                        $query = mysqli_query($link,$str);
                         $row = mysqli_fetch_assoc($query);
                         
                        ?>
                <form class="form-horizontal" action="all_update.php" method="post">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label">App ID</label>
                            <div class="col-sm-5">
                          <input type="text" class="form-control" name="ads_id"  value = "<?php echo $row['ads_id']?>"placeholder="App ID">
                          
                        </div>
                        <label for="inputName" class="col-sm-1 col-form-label">Banner</label>
                            <div class="col-sm-5">
                          <input type="text" class="form-control" name="banner"  value = "<?php echo $row['banner']?>"placeholder="Banner">
                          
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label">Full</label>
                            <div class="col-sm-5">
                          <input type="text" class="form-control" name="full"  value = "<?php echo $row['full']?>"placeholder="Intrestial Ads">
                          
                        </div>
                        <label for="inputName" class="col-sm-1 col-form-label">Reward</label>
                            <div class="col-sm-5">
                          <input type="text" class="form-control" name="reward"  value = "<?php echo $row['reward']?>"placeholder="reward">
                          
                        </div>
                        <br />
                        <br />
                         <div class="form-group row">
                        <div class="offset-sm-10 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit
                       
                        </button>
                        </div>
                        </div>
                      </div>
                </form>
                </div>
            </div>
            
            </div>
            </div>
            </div>
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
