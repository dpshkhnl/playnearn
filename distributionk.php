  <?php
    include 'db.php';
  extract($_REQUEST);
  // Ranks Update

  if(@$update_ranks) {
     
      $sql = mysqli_query($link,"UPDATE tbl_prize_distribution SET ranks='$ranks',prize='$prize' WHERE id = '$id'");
      
      if($sql){
           header("Location: cricket_distribution_edit.php?id=$id");
			setcookie("update_ranks","Successfull Updated",time()+1);
          
      }else {
          header("Location: cricket_distribution_edit.php?id=$id");
			setcookie("update_ranks","Update Failed",time()+1);
      }
  }
  
  /////////////////Given All Winner User Points ////////////
  
  if(@$given_poin_winner){
      
      $sql = mysqli_query($link,"UPDATE tbl_team_joined SET win_amount = '$points' WHERE username = '$username'");
      if($sql) {
          
          header("Location: cricket_join_user.php?id=$id_back");
			
      } else
      {
         header("Location: cricket_join_user.php?id=$id_back");
      }
  }
  
if(@$winner_point) {
        $response = "";
        $first_check = mysqli_query($link, "SELECT * FROM tbl_team_joined WHERE tbl_team_id='$id' AND win_amount!=0 AND payout_status!=1");
        if(mysqli_num_rows($first_check) >= 1){
            while($res=mysqli_fetch_assoc($first_check)){
                $username = $res['username'];
                $point = $res['win_amount'];
                $date = date("Y-m-d");
                $tracker = mysqli_query($link, "INSERT INTO tracker SET username = '$username',points = '$point',type='Quiz Wining Point',date = '$date'");
                $update_payout_status = mysqli_query($link, "UPDATE tbl_team_joined SET payout_status = 1 WHERE username='$username' AND tbl_team_id='$id'");
                if($update_payout_status) {
                    $user_point = mysqli_query($link, "UPDATE users SET points = points+'$point ' WHERE username='$username'");
                    $response = "Successfull Operation";
                } else {
                     $response = "Failed";
                }
           
            }
        }else {
            $response = "Check User Wining Points OR Payment Status Done";
        }
        
  echo $response;
    }
   
  ?>