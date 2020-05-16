<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Activity Tracker</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

  <?php
  include 'db.php';
  include 'session.php';
  include  'nav_barr.php';
  include  'side_bar.php';?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Prize Distribution </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="cricket_prize_distribution.php">Back</a></li>
              <li class="breadcrumb-item active">Distribution</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title">Prize Distribution</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        
                    </div>
                </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php extract($_REQUEST);
                $sql = mysqli_query($link,"SELECT * FROM tbl_prize_distribution WHERE id = '$id'");
                $res = mysqli_fetch_assoc($sql);
                
                ?>
              <form action = "distributionk.php" method="POST">
  <div class="form-group">
    <label for="ranks">Ranks</label>
     <input type="hidden" class="form-control" id="id" name="id" value = "<?php echo $id;?>">
      <input type="hidden" class="form-control" id="update_ranks" name="update_ranks" value = "1">
     
    <input type="text" class="form-control" id="ranks" name="ranks" value = "<?php echo $res['ranks'];?>" placeholder="Enter Ranks">
    
  </div>
  <div class="form-group">
    <label for="prize">Prize</label>
    <input type="number" class="form-control" id="prize" name="prize"value = "<?php echo $res['prize'];?>"placeholder="Prize">
  </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php if(isset($_COOKIE['update_ranks'])){
          echo "".$_COOKIE['update_ranks']."";
        }?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php';?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'common_js.php';?>
<!-- page script -->

</body>
</html>
