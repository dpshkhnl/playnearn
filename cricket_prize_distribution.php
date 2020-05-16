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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        <button type="button" class="btn btn-primary" onclick="show_data();">+ Add</button>
                    </div>
                </div>
              
            </div>
            
            <form id="add_ranks_holder" class="col-sm-12">
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-header">
             <div class ="row">
                          
                        <div class="col-sm-5  justify-content-center align-self-center text-center">
                             <input type="hidden" name="tbl_team_id" class="form-control" placeholder="" value="<?php extract($_REQUEST); echo $id;?>">
                              
                            <input type="number" name="ranks" id="ranks"class="form-control" placeholder="Add Ranks" required="required">
                        </div> 
                        <div class="col-sm-5  justify-content-center align-self-center text-center">
                           
                            <input type="number" name="prize" id ="prize" class="form-control" placeholder="prize" required="required">
                            </div> 
                        
                        <div class="col-sm-2 justify-content-center align-self-center text-center">
                           
                            <button type="button" onclick="add_ranks()" class="btn btn-primary form-control">Add</button>
                        </div> 
                                           
            </div>
            </div>
            </div>
            </div>
           </form>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                 <th>Tbl_id</th>
                 <th>Ranks</th>
                  <th>Prize</th>
                  <th>Operation</th>
                 
                  
                  
                  
                </tr>
                </thead>
                <tbody>
                 <?php
                 extract($_REQUEST);
                  
                  
                  $str1="SELECT * FROM tbl_prize_distribution WHERE tbl_team_id='$id'";
                  
                
                  
                  $query=mysqli_query($link,$str1);
                  $i=1;
                while($row=mysqli_fetch_array($query)){
                   
                 echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['tbl_team_id']."</td>
                <td>".$row['ranks']."</td>
                <td>".$row['prize']."</td>
                 <td><a href='cricket_distribution_edit.php?id=".$row['id']."'<button type='button' class='btn btn-primary'>Edit</button></td>
                 
                 
                
                
             </tr>
             
          ";
                  
            $i++;      
          
}                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                 <th>Team Id</th>
                 <th>Ranks</th>
                  <th>Prize</th>
                  <th>Operation</th>
                  
                  
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
  $(document).ready(function() {
     
     $("#add_ranks_holder").hide();
 
} );
  
 
  
</script>
<script>
    function show_data(){
         $("#add_ranks_holder").show();
        
    }
</script>


</body>
</html>
