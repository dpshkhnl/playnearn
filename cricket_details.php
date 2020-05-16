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
  $sql = mysqli_query($link, "SELECT * FROM tbl_team WHERE id='$id'");
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
      <div class="row">
        <div class="col-12">
          <div class="card">
              
            <div class="card-header">
              
              
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 text-center">
                       <img src="<?php echo $res['team_one_icon']?>" height="200"/>
                    </div>
                    <div class="col-sm-6 text-center">
                       <h4><?php echo $res['quiz_name'];?></h4>
                       <p><?php echo '<img src="'.$res['quiz_type_icon'].'" height="25px">'; echo " ".$res['quiz_type'];?>
                       </p>
                       <div class ="row  h-50 " style="background-color: #e0dddc">
                        <div class="col-sm-3  justify-content-center align-self-center text-center">Date : <?php echo $res['date'];?></div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">Entry Fee : <?php echo $res['entry_fee'];?></div> 
                        <div class="col-sm-3 justify-content-center align-self-center text-center">Prize : <?php echo $res['quiz_prize'];?></div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">Total Seat : <?php echo $res['total_allowed'];?></div> 
                        
                       </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <img src="<?php echo $res['team_two_icon'];?>" height="200"/>
                    </div>
                    
                    <div class="col-sm-12"><hr></div>
                    
                     <div class="col-3 text-center">
                       Question : <?php echo $res['total_question'];?>
                    </div>
                    <div class="col-6 text-center">
                      Status : <?php if($res['status']==1){
                                echo "Draft";
                      } else {
                           echo "Published";
                      }
                      
                      ?>
                    </div>
                    <div class="col-3 text-center">
                    Joined Seat :  <?php echo $res['total_joined'];?>
                    </div>
                    <div class="col-sm-12"><hr></div>
                    <div class="col-sm-12">
                    <div class="col-sm-6 ">
                    <a href="cricket_edit.php?id=<?php echo $id;?>"<button type="button" class="btn btn-success">Edit</button></a>
                    <a href ="cricket_join_user.php?id=<?php echo $id;?>"<button type="button" class="btn btn-success">User Join List</button></a>
                    <a href ="cricket_prize_distribution.php?id=<?php echo $id;?>"<button type="button" class="btn btn-success">Prize Distribution</button></a>
                    <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                    
                    </div>
                </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
             <!-- /.Questuin -->
             <form id="question" class="col-sm-12">
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-header">
             <div class ="row">
                          
                        <div class="col-sm-5  justify-content-center align-self-center text-center">
                             <input type="hidden" name="add_question" class="form-control" placeholder="Question" value="1">
                              <input type="hidden" name="tbl_team_id" class="form-control" placeholder="Question" value="<?php echo $res['id']?>">
                            <input type="text" name="question" id="ddddd"class="form-control" placeholder="Question" required="required">
                        </div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">
                           
                            <input type="text" name="opt1" id ="opt1_add" class="form-control" placeholder="Option 1" required="required">
                            </div> 
                        <div class="col-sm-3  justify-content-center align-self-center text-center">
                          
                            <input type="text" name="opt2" id ="opt2_add"class="form-control" placeholder="Option 2" required="required">
                        </div> 
                        <div class="col-sm-1 justify-content-center align-self-center text-center">
                           
                            <button type="button" onclick="addquestion()" class="btn btn-primary form-control">Add</button>
                        </div> 
                                           
            </div>
            </div>
            </div>
            </div>
           </form>
              <!-- /.End Question -->
              
           
              
          <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              <div class="col-sm-6">All Question</div>
              <div class="col-sm-6 text-right"><button type ="button" onclick="showform()" class="btn btn-primary"><i class='fa fa-plus' aria-hidden='true'></i> Add Question</button></div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="card-body">
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="container">
             
             
            
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                    </div>
                    <div class="modal-body">
                     <form  action="cricket_update.php" method="post">
                        <div class="row">
                            <div class ="col-sm-12">
                                
                                <input type="hidden" name = "tbl_team_id" value="<?php echo $res['id'];?>" >
                                <input type="hidden" name = "update_question" value="1" >
                                <input type="hidden" name = "question_id" value="" id = "question_id">
                          <select class="browser-default custom-select" name="correct" >
                             
                              <option value="1">Option 1</option>
                              <option value="2">Option 2</option>
                              
                            </select>
                            </div>
                            
                             <div class ="col-sm-12">
                                 
                            </div>
                            <div class ="col-sm-12 mt-3 text-right">
                                 <button type="submit"  class="btn btn-primary text-center">Update</button>
                            </div>
                            
                        </div>
                       </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<script>

  $(document).ready(function() {
     my_data_list(<?php echo $res['id'];?>);
     $("#question").hide();
      $("#example1").DataTable();
   
     
} );
function edit_question(id){
   
       $("#question_id").val(id);
   
}
function conform(){
    confirm("hi");
}
function showform(){
    $("#question").show();
}


  
</script>
<script type="text/javascript">
  function addquestion(){
          if($('#question_add').val() == ''){
      alert('Enter Question');
      return false;
   }
   if($('#opt1_add').val() == ''){
      alert('Enter Option 1');
      return false;
   }
   if($('#opt2_add').val() == ''){
      alert('Enter Option 2');
      return false;
   }
      var data_from = $("#question").serialize();
     
    $.ajax({
        url:"cricket_update.php",
       data:data_from,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
            $("#question").hide();
        alert(result);
        my_data_list(<?php echo $res['id'];?>);
        }
      })
    
  }
  function deletequestion(id){
      var confirm1 = confirm("Are You Sure?");
      if(confirm1) {
    $.ajax({
        url:"cricket_update.php",
        data:"delete_question=1&id="+id,
       //data:{"id":id},
        method:"POST",
        cache:false,
        success:function(result){
        alert(result);
        $("#question").hide();
        my_data_list(<?php echo $res['id'];?>);
        }
      })
      }
  }
</script>

<script>
  function my_data_list(id){
         $.ajax({
        url:"cricket_update.php",
        data:"id="+id+"&get_id_question="+1,
        method:"get",
        cache:false,
        success:function(result){
       $("#card-body").html(result);
         $("#example1").DataTable();
         
        }
      })
  }
</script>

</body>
</html>
