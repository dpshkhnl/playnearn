<?php
include 'db.php';

extract($_REQUEST);
///get All Cricket Quiz Contest 

if(@$get_quiz_list) {
  
        $str="SELECT * FROM tbl_team";
        $query=mysqli_query($link,$str);
            $data=array();
                  
                echo '<table id="example1" class="table table-striped table-bordered" style="width:100%">
    
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Quiz Name</th>
                  <th>Team 1 & Team 2</th>
                  <th>Fee</th>
                  <th>Prize</th>
                  <th>Date</th>
                  <th>Join/Allow</th>
                  <th>Oparate</th>
                </tr>
                </thead>
                <tbody>';
                
                  while($row=mysqli_fetch_array($query)){
                  $id_e = $row['id'];
                  $status = $row['status'];
                  $active = "btn-success";
                  $str = "";
                  if($status==0){
                    $str = "Active";
                  }else{
                  $str = "Disable";
                  $active="btn-danger";
                 } 
                 $view = "<i class='fa fa-eye' aria-hidden='true'></i>";
                 $name=$row['quiz_name'];
                 
                
                
              //  $data[]=array("id"=>$id_e,"name"=>$name,"username"=>$username,"email"=>$email,"str"=>$str,"active"=>$active);
                echo "<tr>
                <td>".$row['id']."</td>
                <td>".$name."</td>
                <td style='text-align:center;'><img src='".$row['team_one_icon']."' alt='Team 1' width='40'>vs<img src='".$row['team_two_icon']."' alt='Team 1' width='40'></td>
                <td>".$row['entry_fee']."</td>
                <td>".$row['quiz_prize']."</td>
                <td>".$row['date']."</td>
                <td>".$row['total_joined']."/".$row['total_allowed']."</td>
                <td><button class='btn ".$active."' onclick='update_user($id_e);'>".$str."</button>&nbsp;&nbsp;<a href='cricket_details.php?id=$id_e'<button class='btn btn-primary'>$view</button></a> </td>
             </tr>
          ";
          
                }
                
                echo '</tbody>
                
              </table>';
              
                //echo json_encode($data);
         
}

//Quiz Disable or Enable 

if(@$update_quiz_status) {
	$response = array();
	
	$query = mysqli_query($link,"SELECT status FROM `tbl_team` WHERE id = $id");
	$result = mysqli_fetch_assoc($query);

	if($result['status']==0) {
		$str = mysqli_query($link,"UPDATE tbl_team SET status = '1' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	}
	} else if ($result['status']==1) {
		$str = mysqli_query($link,"UPDATE tbl_team SET status = '0' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	} 
		
	}

	
	echo json_encode($response);
	}
////////////Get ID by Question ////////////////////////////////

if(@$get_id_question) {
  
        $str="SELECT * FROM tbl_question WHERE tbl_team_id='$id'";
        $query=mysqli_query($link,$str);
            $data=array();
                  
                echo '<table id="example1" class="table table-striped table-bordered" style="width:100%" >
    
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Question</th>
                  <th>Option 1</th>
                  <th>Option 2</th>
                  <th>Correct</th>
                   <th>Oparate</th>
                </tr>
                </thead>
                <tbody>';
                
                  while($row=mysqli_fetch_array($query)){
                  
                 $view = "<i class='fa fa-edit' aria-hidden='true'></i>";
                 $delete = "<i class='fa fa-trash' aria-hidden='true'></i>";
                  echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['question']."</td>
                <td >".$row['opt1']."</td>
                <td>".$row['opt2']."</td>
                <td>".$row['correct']."</td>
                
                <td><button onclick ='edit_question(".$row['id'].")'data-toggle='modal' data-target='#myModal' class='btn btn-primary'>$view</button> <button class='btn btn-danger' onclick='deletequestion(".$row['id'].");'>$delete</button></td>
             </tr>
          ";
          
                }
                
                echo '</tbody>
                
                
              </table>';
              
              
                //echo json_encode($data);
         
}
///////////////Edit or Update Quiz Data

if(@$edit_quiz_data){
    
    
    $sql = mysqli_query($link, "UPDATE tbl_team SET quiz_name='$quiz_name', quiz_type='$quiz_type', quiz_type_icon='$quiz_type_icon',team_one_icon='$team_one_icon',team_two_icon='$team_two_icon',date='$date',entry_fee='$entry_fee',quiz_prize='$quiz_prize',total_allowed='$total_allowed',time='$time' WHERE id = '$id'");
    if($sql){
      
                    header("Location: cricket_edit.php?id=$id");
			        setcookie("cricket_update"," Update successfull",time()+1);
    }else {
                    header("Location: cricket_edit.php?id=$id");
			        setcookie("cricket_update"," Failed",time()+1);
			         
    }
}
//////////////////////Add Quiz Data Main//////////////

if(@$add_quiz_data){
    
    
    $sql = mysqli_query($link, "INSERT INTO tbl_team SET status = '$status',quiz_name='$quiz_name', quiz_type='$quiz_type', quiz_type_icon='$quiz_type_icon',team_one_icon='$team_one_icon',team_two_icon='$team_two_icon',date='$date',entry_fee='$entry_fee',quiz_prize='$quiz_prize',total_allowed='$total_allowed',time='$time'");
    if($sql){
                   
                    header("Location: cricket.php");
			        setcookie("cricket_add","Added successfull",time()+1);
    }else {
                    
                    header("Location: cricket.php");
			        setcookie("cricket_add", "Failed",time()+1);
			         
    }
}

/////////Add Question By Quiz /////////////////////////

if(@$add_question) {
    
        $sql = mysqli_query($link, "INSERT INTO tbl_question SET question='$question',opt1='$opt1',opt2='$opt2',tbl_team_id='$tbl_team_id' correct = 3");
        
        if($sql){
            $update_count = mysqli_query($link, "UPDATE tbl_team SET total_question = total_question +'1' WHERE id =  '$tbl_team_id'");
            echo " Succesfully Inserted!";
        }else {
            echo "Something Gone Wrong!";
        }
}
//// DELETE Question
if(@$delete_question) {
        $select = mysqli_query($link, "SELECT * FROM tbl_question WHERE id='$id'");
        $res = mysqli_fetch_assoc($select);
        
        
        if($select){
            $team_id = $res['tbl_team_id'];
            $update_count = mysqli_query($link, "UPDATE tbl_team SET total_question = total_question -1 WHERE id =  '$team_id'");
            $sql = mysqli_query($link, "DELETE FROM tbl_question WHERE id='$id'");
            echo " Delete Successfull!";
        }else {
            echo "Something Gone Wrong!";
        }
}

// Update Question answer and give user Points 

if(@$update_question) {
    
    $right_point = "2";
    $wrong_point = "-2";
    
    $select_question = mysqli_query($link,"SELECT * FROM tbl_question WHERE id = '$question_id'");
    $res = mysqli_fetch_assoc($select_question);
    if($res["correct"]==0) {
       //update Question Correct Anser
       $update_question1 = mysqli_query($link, "UPDATE tbl_question SET correct = '$correct' WHERE id ='$question_id'");
       
       if($update_question1){
            //Select Username Who Answer the Question
           $select_attempt_user = mysqli_query($link,"SELECT * FROM tbl_all_joined_question WHERE tbl_team_id = '$tbl_team_id' AND tbl_question_id = '$question_id'");
           // $result = mysqli_fetch_assoc($select_attempt_user);
           if(mysqli_num_rows($select_attempt_user)==0){
               header("Location: cricket_details.php?id=$tbl_team_id");
               return false;
           }
            while($result = mysqli_fetch_assoc($select_attempt_user)) {
                $username = $result['username'];
                $user_answer = $result['user_answer'];
                $date = date("Y-m-d");
                echo $username ;
                if($user_answer==$correct){
                    //user Given Point for Correct Anser
                    $given_point = mysqli_query($link, "UPDATE tbl_team_joined SET point = point +'$right_point' WHERE tbl_team_id = '$tbl_team_id' AND username = '$username'");
                    //Add Team Activity Tracker
                   $tracker = mysqli_query($link, "INSERT INTO team_activity_tracker SET tbl_team_id ='$tbl_team_id',tbl_question_id='$question_id',entry_date='$date', username='$username',point = point+'$right_point',type='Correct Answer'");
                  header("Location: cricket_details.php?id=$tbl_team_id");
                 } else {
                     //user Given - Point for Wrong Anser
                    $given_point = mysqli_query($link, "UPDATE tbl_team_joined SET point = point +'$wrong_point' WHERE tbl_team_id = '$tbl_team_id' AND username = '$username'");
                    $tracker = mysqli_query($link, "INSERT INTO team_activity_tracker SET tbl_team_id ='$tbl_team_id',tbl_question_id='$question_id',entry_date='$date', username='$username',point = point+'$wrong_point',type='Wrong Answer'");
                    header("Location: cricket_details.php?id=$tbl_team_id");
                 }
                
            }
          
          
        }else {
 
            echo "Something Gone Wrong Try Again";
            return false;
        }
    }else {
        echo "Already Answer Set";
        return false;
    }
    
}

?>