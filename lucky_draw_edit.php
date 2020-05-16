<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Lucky Draw</title>
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
  extract($_REQUEST);
  
  $edit_equry = mysqli_query($link, "SELECT * FROM lucky_draw WHERE id='$id'");
  $row = mysqli_fetch_assoc($edit_equry);
  $status="0";
  $status_color = "btn-success";
  if($row['status']==1) {
    $status = "1";
    $status_color = "btn-danger";
}
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
              <li class="breadcrumb-item active">Edit Lucky Draw </li>
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

                <h3 class="profile-username text-center"><?php echo $row['lucky_draw_name'];?></h3>

                <p class="text-muted text-center"><?php echo "Total Allow User :".$row['total_allow_user'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Joined user</b> <a class="float-right"><?php echo $row['total_user'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Draw Fee </b> <a class="float-right"><?php echo $row['draw_fee'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Date Result</b> <a class="float-right"><?php echo $row['date_result'];?></a>
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
                  
                  <li class="nav-item"></li>
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
                        <label for="inputName" class="col-sm-1 col-form-label">ID</label>
                        <div class="col-sm-1">
                          <input type="text" class="form-control" name = "id" id="inputName" readonly="readonly"value = "<?php echo $row['id'];?>"placeholder="id">
                        </div>
                        <label for="inputName" class="col-sm-1 col-form-label">Game Name</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="lucky_draw_name" value = "<?php echo $row['lucky_draw_name'];?>"placeholder="Game Name">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Status</label>
                        <div class="col-sm-3">
                          <select class="form-control" id="cars" name= "status">
                                    
                                    <?php
                                    $status = "";
                                    if($row['status']==1) {
                                        $status = "selected";
                                    }else {
                                        $status = "";
                                    }
                                    echo '<option value="0" '."$status".'>Active</option>
                                    <option value="1" '."$status".'>Result Out</option>'
                                    ;?>
                                    
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Draw Prize</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputEmail" name="prize"value = "<?php echo $row['prize'];?>"placeholder="Enter Draw Prize">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Fee Rs.</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputEmail" name="draw_fee"value = "<?php echo $row['draw_fee'];?>"placeholder="Fee">
                        </div>
                         <label for="inputEmail" class="col-sm-1 col-form-label">Result Date</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputEmail" name="date_result" value = "<?php echo $row['date_result'];?>"placeholder="Result Date">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-1 col-form-label">Allow User</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputEmail" name="total_allow_user" value = "<?php echo $row['total_allow_user'];?>"placeholder="Total Allow User">
                        </div>
                        <label for="inputEmail" class="col-sm-1 col-form-label">Win Points</label>
                        <div class="col-sm-3">
                            <?php 
                            
                            $win_point = $row['win_point'];
                            $readonly = "readonly";
                            if(empty($row['win_point'])) {
                                $readonly = "";
                            }
                            
                            echo '<input type="number" class="form-control" id="inputEmail" name="win_point" '.$readonly.' value = "'.$win_point.'"placeholder="Winner Points">';
                          
                          ?>
                        </div>
                         <label for="inputEmail" class="col-sm-1 col-form-label">Winner</label>
                        <div class="col-sm-3">
                           <?php 
                            
                            $winner_email = $row['winner_email'];
                            $readonly = "readonly";
                            if(empty($row['winner_email'])) {
                                $readonly = "";
                            }  
                          echo '<input type="text" class="form-control" id="inputEmail" name="winner_email" '.$readonly.' value = "'.$winner_email.'"placeholder="Enter Winner Username">';
                          ?>
                          <input type="hidden" class="form-control" name="lucky_draw_details_update" value ="1">
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
       
       <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Showing All Joined User List </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    
                <thead>
                <tr>
                  <th>ID</th>
                  
                  <th>Username(s)</th>
                  <th>Email</th>
                 
                </tr>
                </thead>
                <tbody>
               <?php
               $str="SELECT * FROM my_contests WHERE game_id_name ='$id'";
                  $count = mysqli_num_rows($str);     
                  $query=mysqli_query($link,$str);
                  $data=array();
                  while($row=mysqli_fetch_array($query)){
                 
                 $username=$row['username'];
                 $email=$row['game_email'];
                
                
                
              //  $data[]=array("id"=>$id_e,"name"=>$name,"username"=>$username,"email"=>$email,"str"=>$str,"active"=>$active);
                echo "<tr>
                <td>".$row['id']."</td>
                <td>".$username."</td>
                <td>".$row['game_email']."</td>
                
             </tr>
          ";
               
                  }
               ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>ID</th>
                 
                  <th>Username(s)</th>
                  <th>Email</th>
                
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
