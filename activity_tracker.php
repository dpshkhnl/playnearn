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
            <h1>All Activity</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tracker</li>
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
              <h3 class="card-title">Showing All User Acivity </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                 <th>Username(s)</th>
                  <th>Points</th>
                  <th>Type</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                 <?php
                 extract($_REQUEST);
                  
                  
                  $str1="SELECT * FROM tracker";
                  if(@$username) {
                    $str1="SELECT * FROM tracker WHERE username LIKE '%$username%'";
                  }
                
                  
                  $query=mysqli_query($link,$str1);
                  
                while($row=mysqli_fetch_array($query)){
                 echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['username']."</td>
                <td>".$row['points']."</td>
                <td>".$row['type']."</td>
                <td>".$row['date']."</td>
                
             </tr>
          ";
                  
                  
          
}
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                 <th>Username(s)</th>
                  <th>Points</th>
                  <th>Type</th>
                  <th>Date</th>
                </tr>
                </tfoot>
              </table>
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
<script>
  $(function () {
    $("#example1").DataTable();
    
  });
</script>


</body>
</html>
