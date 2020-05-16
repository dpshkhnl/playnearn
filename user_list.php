<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>All Registerd User</title>
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
 
  include  'nav_barr.php';
  include  'side_bar.php';
  
  
  
  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
              <h3 class="card-title">Showing All Available User </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
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
<?php include 'footer.php';
include  'side_bar.php';
?>

  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php  include 'common_js.php';?>
<!-- jQuery -->

<!-- page script -->
<script>

  $(document).ready(function() {
     my_data_list();
     $("#example1").DataTable();
   
     
} );
</script>
<script type="text/javascript">
  function update_user(id){
    var update_confirm=confirm("Are you Sure To this Operation");
    if(update_confirm){
      $.ajax({
        url:"all_update.php",
       data:"id="+id+"&user_update="+1 ,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
     var obj=JSON.parse(result);
        if(obj.result=="success"){
            my_data_list();
              }else{
                alert(result);
              }
        }
      })
    }
  }

/////////////////////////////////
  function my_data_list(){
      
 
      
       $.ajax({
        url:"all_update.php",
        data:"get_user_list=data",
        method:"get",
        cache:false,
        success:function(result){
       $(".card-body").html(result);
        $("#example1").DataTable();
         
        }
      })
  }
</script>

</body>
</html>
