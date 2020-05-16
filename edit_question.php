<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>All Sports Quiz</title>
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
  $sql = mysqli_query($link, "SELECT * FROM tbl_question WHERE id='$id'");
  $res = mysqli_fetch_assoc($sql);
  
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
              <li class="breadcrumb-item active">Sports Quiz</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
     <div class="card">
              <div class="card-header">
 Correct User Answer
            </div>
            <div class="card-body">
      <div class="container">
          
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Correct Answer </div>
                <div class="panel-body">
                    <form role="Form" method="post" action="cricket_update.php" accept-charset="UTF-8">
						<div class="form-group">
							<label for="question">Question</label>
							<input type="text" id="question" class="form-control" name="question" value="<?php echo $res['question']?>"placeholder="Question">
						</div>
                        <div class="form-group">
							<label for="opt1">Option 1</label>
							<input type="text" id="opt1" class="form-control" name="opt1" value="<?php echo $res['opt1']?>"placeholder="Option 1">
                        </div>
                        <div class="form-group">
							<label for="opt2">Option 2</label>
							<input type="text" id="opt2" class="form-control" name="opt2" value="<?php echo $res['opt2']?>"placeholder="Option 1">
                        </div>
						<div class="form-group">
							<label for="correct">Select Right Answer</label>
							
							<select id="correct" class="form-control" name="correct">
							    <?php 
							    
							    $selected = "";
							    if($res['correct']==1){
							        $selected = "selected";
							    }
							    
							    echo '
								<option value="1" '.$selected.'>Option 1</option>
								<option value="2" '.$selected.'>Option 2</option>';
								?>
								
							</select>
                        </div>
                        
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary btn-lg" id="submitbtn" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
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
