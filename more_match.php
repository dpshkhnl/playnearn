<html>
    <head>
        <title>Bootstrap Example</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <section class="content">
         <div class="row">
             
             <?php 
           $json = file_get_contents("http://wpwala.com/cric_api/update_score.php?for=web");
            $data=array();
            $data = json_decode($json, true);
            foreach ($data as $key=>$value) { 
               
                if($value["status"]=="") {
                     
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
                
                echo '<h3>'. $series_name.'</h3>
                    <h4>'.$team1.' vs '.$team2.', <span>'.$match_number.'</span>
                
                <hr>
                       ';

            }
              
?>
<div class="container-fluid">
  <h1>Hello World!</h1>
  <p>Resize the browser window to see the effect.</p>
  <p>The columns will automatically stack on top of each other when the screen is less than 768px wide.</p>
  <div class="row">
    <div class="col-sm-6" style="background-color:lavender;">.col-sm-4</div>
    <div class="col-sm-6" style="background-color:lavenderblush;">.col-sm-4</div>
    
  </div>
</div>         
    </body>
    <script>
        function refresh_data(){
      
 
      
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
</html>