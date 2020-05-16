<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quick Earn | Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include 'common_css.php'; ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php
  include 'db.php';

  include  'nav_barr.php';
  include  'side_bar.php';
  //error_reporting(0);
  $result = mysqli_query($link,"SELECT * FROM users");
  $total_user = mysqli_num_rows($result);

   //New Payment Request 
  $currentDateTime = date('Y-m-d');
  $new_payment_request = mysqli_query($link,"SELECT * FROM payment_requests WHERE date = '$currentDateTime'");
  $total_new_payment = mysqli_num_rows($new_payment_request);
  if($total_new_payment==0) {
    $total_new_payment="0";
  }

  //All Payment Request
  $all_payment_request = mysqli_query($link,"SELECT * FROM payment_requests");
  $all_payment = mysqli_num_rows($all_payment_request);

  if($all_payment==0){
    $all_payment ="0";
  }

  //Daily Tracker

   $tracker = mysqli_query($link,"SELECT * FROM tracker WHERE date='$currentDateTime'");

    $today_tracker = mysqli_num_rows($tracker);
    if($today_tracker==0) {
      $today_tracker = "0";
    }
    
  ?>
  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo "$total_user"?></h3>

                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="user_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo "$all_payment"?></h3>

                <p>Payment Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="payment_request.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo "$total_new_payment"?></h3>

                <p>Today's Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="payment_request.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo "$today_tracker"?></h3>

                <p>Today's Activity</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="activity_tracker.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                   Lucky Draw Game

                   <?php
          if(isset($_COOKIE['draw_delete'])){
          echo "".$_COOKIE['draw_delete']."";
        }?>
                </h3>
                <div class="card-tools">
                   <button type="button"
                          class="btn btn-primary btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                 <div class="card-tools mr-1">
                  <a href = "add_lucky_draw.php">
                   <button type="button"
                          class="btn btn-primary btn-sm"
                          >
                    Add New
                  </button></a>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       >
                        <div class="card-body ">
              <table id="example2" class="table table-hover" >
                <thead>
                <tr >
                  <th>ID</th>
                  <th>Lucky Draw</th>
                  <th>Total User</th>
                  <th>Status</th>
                  <th>Prize</th>
                  <th>Operation</th>
                  
                </tr>
                </thead>
                <tbody>
                 <?php
                  $str="SELECT * FROM lucky_draw ORDER BY `id` DESC";
                  $query=mysqli_query($link,$str);
                  while($row=mysqli_fetch_array($query)){
                  $id_e = $row['id'];
                  $btn = "btn-primary";
                  $active = "Running";
                  $game_icon = $row['game_icon'];
                  if($row['status']==1) {
                      $btn = "btn-danger";
                      $active = "Result Out";
                  }
                echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['lucky_draw_name']."</td>
                <td>".$row['total_user']."/".$row['total_allow_user']."</td>
                <td><a href='#' class='btn ".$btn."'>$active</a></td>
                <td>".$row['prize']."</td>
                <td><a href='lucky_draw_edit.php?id=".$row['id']."' class='btn btn-primary '>Edit</a>&nbsp;&nbsp;<input type='button' value='Delete' class='btn btn-danger' onclick='delete_lucky_draw(".$row['id'].");'/></td>
             </tr>
          ";
}?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>         
                   </div>

                </div>
              </div><!-- /.card-body -->
            </div>
            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
 <!-- card tools -->
                 
            <!-- Map card -->
            <div class="card bg-gradient-primary">

              
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-game mr-1"></i>
                  HTML Game
                </h3>
                <!-- card tools -->
               
                <div class="card-tools">
                 
                  <button type="button"
                          class="btn btn-primary btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <div class="card-tools mr-1">
                  <a href = "add_game.php">
                   <button type="button"
                          class="btn btn-primary btn-sm"
                          >
                    Add New
                  </button></a>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <section class="content">
      <div class="row text-muted">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body ">
              <table id="example1" class="table table-hover" >
                <thead>
                <tr >
                  <th>Name</th>
                  <th>Game Play</th>
                  <th>Icon</th>
                  <th>Oparate</th>
                  
                </tr>
                </thead>
                <tbody>
                 <?php
                  $str="SELECT * FROM game_list";
                  $query=mysqli_query($link,$str);
                  while($row=mysqli_fetch_array($query)){
                  $id_e = $row['id'];
                  $game_icon = $row['game_icon'];
                echo "<tr>
                <td>".$row['paid_game']."</td>
                <td><a href='".$row['game_url']."' target='_blank' class='btn btn-primary '>Play</a></td>
                <td><img src ='".$game_icon."' height='42' width='42' /></td>
                <td><a href='edit_game.php?id=".$row['id']."' class='btn btn-primary '>Edit</a>&nbsp;&nbsp;<input type='button' value='Delete' class='btn btn-danger' onclick='delete_game(".$row['id'].");'/></td>
             </tr>
          ";
}?>
                </tbody>
                <tfoot>
                
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
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
include 'footer.php';
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php 
include 'common_js.php';
?>
<script>
  $(function () {
    $("#example1").DataTable();
    
  });
  $(function () {
    $("#example2").DataTable();
    
  });
</script>

<script type="text/javascript">
 

</script>
<script type="text/javascript">
  function status(id){
    var status_confirm=confirm("Are you Sure To this Change?");
    if(status_confirm){
      $.ajax({
        url:"all_update.php",
       data:"id="+id+"&lucky_draw_running="+1,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
          
         var obj=JSON.parse(result);
        if(obj.result=="success"){
            location.href="index.php";
              }else{
                alert(result);
              }
        }
      })
    }

  }
///////////////////////////// Delete Lucky Draw

    function delete_lucky_draw(id){
    var status_confirm=confirm("Are You Sure?");
    if(status_confirm){
      $.ajax({
        url:"all_update.php",
       data:"id="+id+"&lucky_draw_delete="+1,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
          
         var obj=JSON.parse(result);
        if(obj.result=="success"){
            location.href="index.php";
              }else{
                alert(result);
              }
        }
      })
    }

  }

  /////////////////////////////////// Delete Game
  function delete_game(id){
    var status_confirm=confirm("Are You Sure?");
    if(status_confirm){
      $.ajax({
        url:"all_update.php",
       data:"id="+id+"&game_delete="+1,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
        var obj=JSON.parse(result);
        if(obj.result=="success"){
            location.href="index.php";
              }else{
                alert(result);
              }
        }
      })
    }

  }

</script>
</body>
</html>
