<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Fantasy Quiz</title>
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
<body class="hold-transition sidebar-mini" >
<div class="wrapper">
  <!-- Navbar -->

  <?php
  include 'db.php';
// onload="update_user($id);"
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
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Fantasy Quiz</li>
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
 
            </div>
            <!-- /.card-header -->
            <form action="cricket_update.php" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 text-center">
                        <label for="team_icon_one" class="col-form-label">Team 1</label>
                         <input type="hidden" name="add_quiz_data" class="form-control" placeholder="id"  value ="1" required="required">
                         <input type="hidden" name="status" class="form-control" placeholder="id"  value ="1" required="required">
                     <input type="text" name="team_one_icon" class="form-control" placeholder="Team 1 Icon URL" required="required">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Ncei-round-icon.png/1035px-Ncei-round-icon.png" height="200px">
                    
                    </div>
                    <div class="col-sm-6 text-center">
                        <label for="team_icon_one" class="col-form-label">Quiz Name</label>
                       <h4><input type="text" name="quiz_name" class="form-control" placeholder="Fantasy Quiz Title"  required="required"></h4>
                       <label for="team_icon_one" class="col-form-label">Quiz Type</label>
                       <p><input type="text" name="quiz_type" class="form-control" placeholder="Quiz Type - One Day, T20"  required="required"></p>
                       <div class ="row  h-50 " style="background-color: #e0dddc">
                           
                        <div class="col-sm-3  justify-content-center align-self-center text-center">
                            <label for="team_icon_one" class="col-form-label">Date</label>
                            <input type="text" name="date" class="form-control" placeholder="27-02-2020" required="required">
                        </div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">
                            <label for="team_icon_one" class="col-form-label">Time</label>
                            <input type="text" name="time" class="form-control" placeholder="00:00:00" required="required">
                            </div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">
                            <label for="team_icon_one" class="col-form-label">Entry Fee</label>
                            <input type="number" name="entry_fee" class="form-control" placeholder="Per User Entry Fee" required="required">
                        </div> 
                        <div class="col-sm-3 justify-content-center align-self-center text-center">
                            <label for="team_icon_one" class="col-form-label">Prize</label>
                            <input type="number" name="quiz_prize" class="form-control" placeholder="Pool Prize" required="required">
                        </div> 
                        
                        
                       </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <label for="team_icon_two" class="col-form-label">Team 2</label>
                       <input type="text" name="team_two_icon" class="form-control" placeholder="Team 2 Icon URL"  required="required">
                                              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Ncei-round-icon.png/1035px-Ncei-round-icon.png" height="200px"> 
                     
                       
                    </div>
                    
                    <div class="col-sm-12"><hr></div>
                    
                     <div class="col-3 text-center">
                         <label for="team_icon_one" class="col-form-label">Quiz Type Icon</label>
                       <input type="text" name="quiz_type_icon" class="form-control" placeholder="Quiz Type ICON URL" required="required">
                    </div>
                    <div class="col-6 text-center">
                     
                    </div>
                    <div class="col-3 text-center">
                        <label for="team_icon_one" class="col-form-label">Total Allow</label>
                    <input type="text" name="total_allowed" class="form-control" placeholder="Join Allow " required="required">
                    </div>
                    <div class="col-sm-12"><hr></div>
                    <div class="col-sm-12">
                    <div class="col-sm-6 ">
                    <button type="submit" class="btn btn-success">Add</button>
                     </div>
                    
                    </div>
                </div>
              
            </div>
            </form>
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

  
</div>
<!-- ./wrapper -->
 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
<?php  include 'common_js.php';?>
<!-- jQuery -->

<!-- page script -->


</body>
</html>
