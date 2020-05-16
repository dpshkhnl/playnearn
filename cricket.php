<?php include 'session.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quiz Fantasy</title>
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
            <h1> <?php if(isset($_COOKIE['cricket_update'])){
          echo "".$_COOKIE['cricket_update']."";
        }?></li></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Game Quiz</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
         <div class="row">
             
             <?php 
           $json = file_get_contents("http://wpwala.com/cric_api/update_score.php?for=web");
            $data=array();
            $data = json_decode($json, true);
            foreach ($data as $key=>$value) { 
               
                if($value["status"]==1) {
                     
                    $series_name =  $value["series_name"];
                    $match_type = $value["match_type"];
                    $event_time = $value["event_time"];
                    $flag1 = $value["flag1"];
                     $flag2 = $value["flag2"];
                     $match_number = $value["match_number"];
                     $match_status = $value["match_status"];
                     $score = $value["score"];
                     $score2= $value["score2"];
                     $session_type= $value["flag1"];
                     $t1= $value["flag1"];
                     $t2= $value["flag1"];
                     $team1= $value["team1"];
                     $team2= $value["team2"];
                     $venue= $value["venue"];
                     $wicket= $value["wicket"];
                     $wicket2= $value["wicket2"];
                     $title= $value["title"];
                     $total_balls = $value["total_balls"];
                     
                     $ballsdone =$value["ballsdone"];
                     $ballsdone2 = $value["ballsdone2"];
                     $comment = $value["comment"];
                     
                    
                }else{
                      
                    $series_name =  $value["series_name"];
                    $match_type = $value["match_type"];
                    $event_time = $value["event_time"];
                    $flag1 = $value["flag1"];
                     $flag2 = $value["flag2"];
                     $match_number = $value["match_number"];
                     $match_status = $value["match_status"];
                     $score = $value["score"];
                     $score2= $value["score2"];
                     $session_type= $value["flag1"];
                     $t1= $value["flag1"];
                     $t2= $value["flag1"];
                     $team1= $value["team1"];
                     $team2= $value["team2"];
                     $venue= $value["venue"];
                     $wicket= $value["wicket"];
                     $wicket2= $value["wicket2"];
                     $title= $value["title"];
                     $total_balls = $value["total_balls"];
                     
                     $ballsdone =$value["ballsdone"];
                     $ballsdone2 = $value["ballsdone2"];
                     $comment = $value["comment"];
                }

            }
              
?>
             
             
             
             
             
             
             
             
                    <div class="col-sm-3 text-center">
                       <img src="<?php echo $flag1; ?>" height="200"/>
                       <h4><?php echo $team1;?></h4>
                        <h4><?php 
                            if($score==0) {
                                echo "--/--";
                            } else {
                                echo $score."/".$wicket."*";
                            }
                         ?></h4>
                        <b><?php echo (round($ballsdone/6,1) ." Over");?></b>
                    </div>
                    <div class="col-sm-6 text-center">
                       <h4><?php echo $title;?></h4>
                       <p><?php echo '<img src="'.$flag1.'" height="25px">'; echo " ".$match_type; echo ", ".$match_number.", ".$venue;?></p>
                       <div class ="row  h-50 " style="background-color: #e0dddc">
                        <div class="col-sm-12  justify-content-center align-self-center text-center"><?php echo "Comment : <br>". $comment;?></div> 
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <img src="<?php echo $flag2;?>" height="200"/>
                        <h4><?php echo $team2;?></h4>
                         <h4><?php 
                            if($score2==0) {
                                echo "--/--";
                            } else {
                                echo $score2."/".$wicket2."*";
                            }
                         ?></h4>
                         <b><?php echo (round($ballsdone2/6,1) ." Over");?></b>
                    </div>
                    
                    <div class="col-sm-12"><hr></div>
                    
                     <div class="col-3 text-center">
                      <?php echo $event_time;?>
                    </div>
                    <div class="col-6 text-center">
                      <?php echo $match_status;
                      
                      ?>
                    </div>
                    <div class="col-3 text-center">
                    <a href="more_match.php"<button type="button" class="btn btn-primary">More Match</button></a>
                    </div>
                    <div class="col-sm-12"><hr></div>
                    
                </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                
              <div class="row">
                  <div class="col-sm-6">Showing All Fantasy Quiz</div>
                  <div class="col-sm-6 text-right"><a href="cricket_add.php"><button type ="button" class="btn btn-primary"><i class='fa fa-plus' aria-hidden='true'></i> Add New</button></a></div>
                  
                 </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body data">
              
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
    var update_confirm=confirm("Are you Sure?");
    if(update_confirm){
      $.ajax({
        url:"cricket_update.php",
       data:"id="+id+"&update_quiz_status="+1 ,
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
        url:"cricket_update.php",
        data:"get_quiz_list=data",
        method:"get",
        cache:false,
        success:function(result){
       $(".data").html(result);
         $("#example1").DataTable();
         
        }
      })
  }
</script>

</body>
</html>
