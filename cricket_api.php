<?php
  include 'db.php';

extract($_REQUEST);

// Get All Quiz List
 if(@$get_quiz_list){
   
    $sql = mysqli_query($link, "SELECT * FROM tbl_team");
     $rows = array();
     
     while($res = mysqli_fetch_assoc($sql)){
          $rows[] = $res;
        }
       echo json_encode((['feed' => $rows]));

 }
 /// Get Joined List Quiz
  if(@$get_quiz_join_list){
   
    $sql = mysqli_query($link, "SELECT * FROM tbl_team_joined WHERE username='$username'");
    $rows = array();
     while($res = mysqli_fetch_array($sql)){
         
        $team_id = $res['tbl_team_id'];
        $sql1 = mysqli_query($link, "SELECT * FROM tbl_team WHERE id='$team_id'");
        $result = mysqli_fetch_assoc($sql1);
        $rows[] = $result;

        }
       echo json_encode((['feed' => $rows]));
 }
 /// Get Joined List Quiz////////////////////////////////////////////////////////////////////////////////////////////////
 
  if(@$get_quiz_details){
    
    $sql = mysqli_query($link, "SELECT * FROM tbl_team WHERE id='$id'");
    $res = mysqli_fetch_assoc($sql);
    $check_join = mysqli_query($link,"SELECT * FROM tbl_team_joined WHERE username='$username' AND tbl_team_id='$id'");
    $count = mysqli_num_rows($check_join);
    $get_result = mysqli_fetch_array($check_join);
    $join_status = array('join_status' => $count);
    if($get_result==""){
         $t_status = array('t_status' => 0);
    }else {
         $t_status = array('t_status' => $get_result['t_status']);
    }
   
    
    $final = $res + $join_status+$t_status;
    echo json_encode((['feed' => [$final]]));
 }
 
// Get Prize Distribution ///////////////////////////////////////////////////////////////////////////////////////////////////


  if(@$get_prize_distribution){
   
    $sql = mysqli_query($link, "SELECT * FROM tbl_prize_distribution WHERE tbl_team_id='$id'");
    $rows = array();
    while($res = mysqli_fetch_assoc($sql)){
        $rows[]=$res;
    }
     echo json_encode((['feed' => $rows]));
 }
 
 /// Get Joined Ranks///////////////////////////////////////////////////////////////////////////////////////////////////
 
   if(@$get_joined_user_list){
   
        $str1="SELECT * FROM tbl_team_joined WHERE tbl_team_id = '$id' ORDER BY point DESC";
        $rows = array();
        $data = array();
        $query=mysqli_query($link,$str1);
          $i=1;
           $rank=1;
                $flag="";
                while($row=mysqli_fetch_assoc($query)){
                    //////////////
                    
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
                    ///////////////////
                    $username = $row['username'];
                    $sql = mysqli_query($link,"UPDATE tbl_team_joined SET rank = '$rank' WHERE username = '$username'");
                    
                    
                    
                    $rows[]=$row;
                    
                }
    echo json_encode((['feed' => $rows]));
                
 }
 
 //////////////////////////////////Join Quiz Fantasy///////////////////////////////////////////////////////
 
 if(@$join_quiz){
     $response= array();
     $check_point = mysqli_query($link,"SELECT points FROM users WHERE username='$username'");
     $res = mysqli_fetch_assoc($check_point);
     if($res['points']>=$points){
         
         $check_join = mysqli_query($link, "SELECT * FROM tbl_team_joined WHERE username='$username'AND tbl_team_id='$tbl_team_id'");
         
         if(mysqli_num_rows($check_join)!=0){
            $response['error'] = true;
        	$response['message'] = "Already Joined";
 
         }else{
              $adding_tracking_record = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$username.'","'.$points.'","'.$type.'","'.date('Y-m-d').'")');
        		$sql = mysqli_query($link,"UPDATE `users` SET `points` = `points` + '".$points."' WHERE `users`.`username` ='".$username."'");
        		$sql = mysqli_query($link,"UPDATE `tbl_team` SET `total_joined` = `total_joined` + 1 WHERE `tbl_team`.`id` ='".$tbl_team_id."'") ;
                $sql = mysqli_query($link,'INSERT INTO `tbl_team_joined`(`tbl_team_id`, `username`, `point`) VALUES 
        							("'.$tbl_team_id.'","'.$username.'",0)');
        	
        		$response['error'] = false;
        		$response['message'] = "Join Successfuly";
        		$response['id'] = mysqli_insert_id[$link];
            }
 
	}else{
		$response['error'] = true;
		$response['message'] = "Not Enough Coins!";
	}
	
	print_r(json_encode($response));

 }
 
 //////////get_question_by_id
 
 if(@$get_question_by_id){
     $response = array();
     $sql = mysqli_query($link, "SELECT * FROM tbl_question WHERE tbl_team_id='$tbl_team_id'");
     while($res=mysqli_fetch_assoc($sql)){
         $response[]=$res;
     }
     
     print_r(json_encode(['question'=>$response]));
 }
 ////////////insert_user_answer
 
 if(@$insert_user_answer){
      $response= array();
      $check_question = mysqli_query($link, "SELECT * FROM tbl_all_joined_question WHERE tbl_question_id = '$tbl_question_id' AND username='$username'");
      
      if($res = mysqli_num_rows($check_question)==1) {
         $question_update = mysqli_query($link,"UPDATE tbl_all_joined_question SET tbl_team_id = '$tbl_team_id',tbl_question_id = '$tbl_question_id', user_answer='$user_answer' WHERE username='$username'");
          if($question_update) {
              $response['error'] = false;
        	    $response['message'] = "Update Succesfull";
          }else {
              $response['error'] = true;
        	  $response['message'] = "Try Again";
          }
          
      } else {
      $question_insert = mysqli_query($link,"INSERT INTO tbl_all_joined_question (tbl_team_id,tbl_question_id, user_answer,username) VALUES ('$tbl_team_id','$tbl_question_id','$user_select','$username')");
      if($question_insert){
          	$response['error'] = false;
        	$response['message'] = "Insert Succesfull";
      } else {
          	$response['error'] = true;
        	$response['message'] = "Something Missing";
      }
 }
      print_r(json_encode($response));
 }
 
 ///check Uer_input anser and Fatch Details

if(@$get_joined_question){
    
    $sql = mysqli_query($link,"SELECT * FROM tbl_all_joined_question WHERE username='$username' AND tbl_team_id='$tbl_team_id'");
    $final=array();
    $i=1;
    while( $res = mysqli_fetch_assoc($sql)){
        $question_id = $res['tbl_question_id'];
        $select_question = mysqli_query($link,"SELECT * FROM tbl_question WHERE id='$question_id'");
        $result = mysqli_fetch_assoc($select_question);
        $correct = $result['correct'];
        $user_answer = $res['user_answer'];
        
        if($correct==$user_answer) {
            //wright
        $user_input = array('user_input' => $user_answer);
        $user_input_status = array('decision' => "correct");
            
            
        } else if ($correct==3){
            //Pending
        $user_input = array('user_input' => $user_answer);
        $user_input_status = array('decision' => "pending");
            
        }else {
            //Wrong
            
        $user_input = array('user_input' => $user_answer);
        $user_input_status = array('decision' => "wrong");
        }
        
        $question_count = array('question_no' => $i);
        $i++;
       $final [] = $result + $user_input + $user_input_status+$question_count;
       
    }
     
    
    echo json_encode((['question' => $final]));
}
  
/// Update t_status Complete Quiz Update
if(@$update_complete) {
    $response = array();
    $sql = mysqli_query($link, "UPDATE tbl_team_joined SET t_status = 1 WHERE tbl_team_id = '$tbl_team_id' AND username='$username'");
    if($sql){
        	$response['error'] = false;
        	$response['message'] = "Quiz Complete";
    }else {
            $response['error'] = true;
        	$response['message'] = "Re_attemp Quiz";
    }
    echo json_encode($response);
}
  ?>