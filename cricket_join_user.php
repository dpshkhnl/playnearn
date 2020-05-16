<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Total Joined Users</title>
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
  include  'side_bar.php';
  extract($_REQUEST);
  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Join List </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Join List</li>
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
                        <h3 class="card-title">Showing All Join List By Ranks  </h3>
                    </div>
                    <div class="col-sm-6 text-right">
                       <button class="btn btn-primary" onclick="winner_point(<?php echo $id;?>);">Send All SET Point to User</button>
                    </div>
                </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                 <th>Username(s)</th>
                 <th>tbl_team_id</th>
                  <th>Points</th>
                  <th>Rank</th>
                  <th>Win Point</th>
                  <th>Payment Status</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                 <?php
                 
                  
                  
                  $str1="SELECT * FROM tbl_team_joined WHERE tbl_team_id = '$id' ORDER BY point DESC";
                  
                
                  
                  $query=mysqli_query($link,$str1);
                  $i=1;
                  $rank=1;
                $flag="";
                while($row=mysqli_fetch_array($query)){
                    ////////////////////////////////////////
                       $pre=$row['point'];
                          if($flag!=$pre){
                               $flag=$pre;
                              if($i!=1){
                                 $rank=$i;
                                      //echo "count<br />";
                                    }
                                $i++;
                               $rank = $rank;
                            }else{
                               $rank = $rank;
                            }
                        $payout_status="Pending";
                        $status_color = "btn-danger";
                     if($row['payout_status']==1){
                         $payout_status = "Payment Done";
                         $status_color = "btn-success";
                         
                     }    
 ///////////////////////////////////
                $username = '"'.$row['username'].'"';
                $sql = mysqli_query($link,"UPDATE tbl_team_joined SET rank = '$rank' WHERE username = '$username'");
                 echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['username']."</td>
                <td>".$row['tbl_team_id']."</td>
                <td>".$row['point']."  </td>
                <td>  <button type='button' class='btn btn-primary' data-toggle='modal' onclick='give_point($username)' data-target='#myModal'> #".$rank." </button></td>
                <td>".$row['win_amount']." (Points)</td>
                
                <td><button type='button' class='btn ".$status_color."'>".$payout_status."</button></td>
                 
                
                
             </tr>
             
          ";
                  
               
          
}
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                 <th>Username(s)</th>
                 <th>tbl_team_id</th>
                  <th>Points</th>
                  <th>Rank</th>
                   <th>Win Amount</th>
                   <th>Payment Status</th>
                  
                  
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
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          
         <p>Add Points</p>
         </div>
      <form action="distributionk.php" method="POST">
      <div class="modal-body">
         
         <div class="row">
             <div class="col-sm-3">
                   <input type="hidden" id = "id_back" readonly="readonly" name = "id_back" value="<?php echo $id;?>"required >
                 <input type="text" class="form-control" id = "username" readonly="readonly" name = "username" required>
             </div>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id = "points" name="points" placeholder="Enter Given Points" required>
             </div>
         </div>
        
       
      </div>
      <div class="modal-footer">
        <button type="submit" value = "given_poin_winner" name ="given_poin_winner" class="btn btn-default">Submit</button>
      </div>
    </div>
    </form>

  </div>
</div>
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
   // $("#example1").DataTable();
    
  });
</script>
<script>
    function give_point(fds){
        $("#username").val(fds);
        
    }
</script>
<script>
    
    
        function winner_point(id){
            var confirm1 = confirm("Once Please Check All User Points or Are you Sure to provide Poins");
        if(confirm1){
         $.ajax({
        url:"distributionk.php",
        data:"id="+id+"&winner_point="+1,
        method:"post",
        cache:false,
        success:function(result){
       alert(result);
         
        }
      })
      
  }
        }
    
  
</script>
</body>
</html>
