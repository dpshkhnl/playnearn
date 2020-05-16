<?php
include 'db.php';

extract($_REQUEST);

/// User Disable /////////////////////
if(@$user_update) {
	$response = array();
	
	$query = mysqli_query($link,"SELECT status FROM `users` WHERE id = $id");
	$result = mysqli_fetch_assoc($query);

	if($result['status']==0) {
		$str = mysqli_query($link,"UPDATE users SET status = '1' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	}
	} else if ($result['status']==1) {
		$str = mysqli_query($link,"UPDATE users SET status = '0' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	} 
		
	}

	
	echo json_encode($response);
	}

	//////////Enf User Disable

/// Payment Request Update /////////////////////
if(@$payment_update && $id) {
	$response = array();
	
	$payment_username_query = mysqli_query($link,"SELECT status FROM payment_requests WHERE id = '$id'");
	$payment_username_get = mysqli_fetch_assoc($payment_username_query);
	

	if($payment_username_get['status']==0) {
		$str = mysqli_query($link,"UPDATE payment_requests SET status = '1' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	}
	} else if ($payment_username_get['status']==1) {
		$str = mysqli_query($link,"UPDATE payment_requests SET status = '0' WHERE id = '$id'");
		if ($str) {
			$response ['result'] = "success";
		}else {
		
		$response ['result'] = "Failed";
	    } 
	
	}
	
            $str="SELECT * FROM payment_requests";
                  $query=mysqli_query($link,$str);
                  echo '<table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                 <th>Username(s)</th>
                  <th>Payment Address</th>
                  <th>Request Type</th>
                  <th>Requested Amount</th>
                  <th>Points Used</th>
                  <th>Status</th>

                </tr>
                </thead><tbody> 
                
                ';
                  while($row=mysqli_fetch_array($query)){
                    $status = "Completed";
                    $active = "btn-success";
                    $id = '"'.$row['id'].'"';
                  if($row['status']==1) {
                    $status = "Pending";
                    $active = "btn-danger";
                  }
                
                echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['username']."</td>
                <td>".$row['payment_address']."</td>
                <td>".$row['request_type']."</td>
                <td>".$row['request_amount']."</td>
                 <td>".$row['points_used']."</td>
                <td><input type='button' class='btn ".$active."' value='".$status."'onclick='payment_requests($id);'/></td> 

                
             </tr>
             
          ";
          
          
          
          
}
echo '</tbody></table>';
	}

	//////////End Payment Request
	
	//////////Lucky Draw Running Status Change

/*	if(@$lucky_draw_running) {
		$response = array();
		$select_lucky_draw = mysqli_query($link, "SELECT status FROM lucky_draw WHERE id = '$id'");
		$result = mysqli_fetch_assoc($select_lucky_draw);
		
		if($result['status']==1) {
			$lucky_draw_query = mysqli_query($link, "UPDATE lucky_draw SET status = 0 WHERE id = '$id'");

				if ($lucky_draw_query) {
					$response ['result'] = "success";
					}else {
					$response ['result'] = "Failed";
				}
		} else if ($result['status']==0) {
				$lucky_draw_query = mysqli_query($link, "UPDATE lucky_draw SET status = 1 WHERE id = '$id'");

				if ($lucky_draw_query) {
					$response ['result'] = "success";
					}else {
		
					$response ['result'] = "Failed";
				}
		}
		echo json_encode($response);
	}
*/
	//////////End Lucky Draw Running Status Change

	//////////Update Luck Draw Details 

	if(@$lucky_draw_details_update){
        
        $check = mysqli_query($link, "SELECT win_point,winner_email FROM lucky_draw WHERE id = '$id'");
            $result = mysqli_fetch_assoc($check);
        
        if(!empty($result['win_point']) && !empty($result['winner_email'])) {
            
            //Second Update
            
               $select_lucky_draw = mysqli_query($link, "UPDATE lucky_draw SET lucky_draw_name = '$lucky_draw_name',prize = '$prize', total_allow_user = '$total_allow_user', draw_fee = '$draw_fee', date_result = '$date_result', status = '$status' WHERE id = '$id'");
        if($select_lucky_draw) {
		
			header("Location: lucky_draw_edit.php?id=$id");
			setcookie("draw_update"," Update successfull",time()+1);
			
		    }else {
			echo "Something Error";
		    }
	
        } else {
                    //First Update
            	    $select_lucky_draw = mysqli_query($link, "UPDATE lucky_draw SET lucky_draw_name = '$lucky_draw_name',prize = '$prize', total_allow_user = '$total_allow_user', draw_fee = '$draw_fee', date_result = '$date_result', status = '$status', winner_email = '$winner_email',win_point = '$win_point' WHERE id = '$id'");
            	    
            	   if(!empty($win_point)&& !empty($winner_email)) {
            	       
            	      //Winner Details Add
            	        $sql = mysqli_query($link, "INSERT INTO draw_result (game_name, user_email,points,game_prize,type) VALUES ('$id','$winner_email','$win_point','$prize','$lucky_draw_name')");
            	        
            	        //give Winner user Points
            	        
            	        $select_lucky_draw = mysqli_query($link, "UPDATE users SET points = points + '".$win_point."' WHERE username = '$winner_email'");
            	        
            	        //Add Tracker
            	        	$adding_tracking_record = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$winner_email.'","'.$win_point.'","'.$lucky_draw_name.'","'.date('Y-m-d').'")');
							
					if($select_lucky_draw) {
		
			        header("Location: lucky_draw_edit.php?id=$id");
			        setcookie("draw_update"," Update successfull",time()+1);
			
		            }else {
			        echo "Something Error";
		                }
						          	        
            	   }else {
            	       header("Location: lucky_draw_edit.php?id=$id");
			        setcookie("draw_update"," Update successfull",time()+1);
            	   }
            	    
        }

		
		

	}
//////////End Update Luck Draw Details 

//////////Delete Lucky_draw

	if(@$lucky_draw_delete) {
		$response = array();
		$select_lucky_draw_query = mysqli_query($link, "DELETE FROM lucky_draw WHERE id = $id");
		if($select_lucky_draw_query) {
			$response ['result'] = "success";
			setcookie("draw_delete"," Delete successfull",time()+1);
		} else {
			$response ['result'] = "success";
			setcookie("draw_delete"," Failed",time()+1);
		}
		echo json_encode($response);
	}

///////////////Delete Game

	if(@$game_delete) {
		$response = array();
		$select_game_query = mysqli_query($link, "DELETE FROM game_list WHERE id = ");
		if($select_game_query) {
			$response ['result'] = "success";
			
			setcookie("game_delete"," Delete successfull",time()+1);
			
		} else {
			$response ['result'] = "Failed";
			setcookie("game_delete"," Failed",time()+1);
			
		}
		echo json_encode($response);
	}

///Add Lucky Draw Game

if(@$lucky_draw_details_add)	{
	$response = array();
	$add_lucky_draw = mysqli_query($link, "INSERT INTO lucky_draw (lucky_draw_name,prize,draw_fee,total_allow_user,date_result) VALUES ('$lucky_draw_name','$prize','$draw_fee','$total_allow_user', '$date_result')");
	if($add_lucky_draw) {
		$response ['result'] = "success";
		header("Location: index.php");
		setcookie("draw_delete"," Insert success",time()+1);

	} else {
		$response ['result'] = "Failed";
		setcookie("draw_delete"," Unable to Add Lucky Draw Game",time()+1);
		header("Location: index.php");

	}
	echo  json_encode($response);
}
///EndAdd Lucky Draw Game

///game_update_data

if(@$edit_game_data) {

	$response = array();

	$update_game_query = mysqli_query($link, "UPDATE game_list SET paid_game = '$paid_game', game_url='$game_url', game_icon='$game_icon', join_fee='$join_fee' WHERE id = '$id'");
	if($update_game_query) {
		$response ['result'] = "success";
		header("Location: edit_game.php?id=$id");
		setcookie("game_update"," Update success",time()+1);

	} else {
		$response ['result'] = "Failed";
		setcookie("game_update"," Unable to Update Game",time()+1);
		header("Location: edit_game.php?id=$id");

	}
	echo  json_encode($response);

}
if(@$add_game_data) {

	$response = array();

	$update_game_query = mysqli_query($link, "INSERT INTO game_list SET paid_game = '$paid_game', game_url='$game_url', game_icon='$game_icon', join_fee='$join_fee'");
	if($update_game_query) {
		$response ['result'] = "success";
		header("Location: add_game.php?id=$id");
		setcookie("game_update"," Update success",time()+1);

	} else {
		$response ['result'] = "Failed";
		setcookie("game_update"," Unable to Update Game",time()+1);
		header("Location: add_game.php?id=$id");

	}
	echo  json_encode($response);

}

//Update Admin Profile

if(@$admin_update) {
    echo "Hi";
        if(!empty($password)) {
            $pwd = md5($password);
            $update_admin = mysqli_query($link, "UPDATE admin SET name = '$name',password = '$pwd', upi_name = '$upi_name', upi_id = '$upi_id', email = '$email' WHERE id = '$id'");
            if($update_admin) {
			header("Location: profile.php");
			setcookie("profile_update"," Update successfull",time()+1);
	
		    }else {
			echo "Something Error";
		    }
            
        } else {
             $update_admin = mysqli_query($link, "UPDATE admin SET name = '$name', upi_name = '$upi_name', upi_id = '$upi_id', email = '$email' WHERE id = '$id'");
             if($update_admin) {
			header("Location: profile.php");
			setcookie("profile_update"," Update successfull",time()+1);
	
		    }else {
			echo "Something Error";
		    }
            
        }
        
}


if(@$get_user_list) {
  
        $str="SELECT * FROM users";
                  $query=mysqli_query($link,$str);
                  $data=array();
                  
                echo '<table id="example1" class="table table-striped table-bordered" style="width:100%">
    
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username(s)</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Points</th>
                  <th>Registerd Date</th>
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
                 
                 $name=$row['name'];
                 $username=$row['username'];
                 $email=$row['email'];
                
                
              //  $data[]=array("id"=>$id_e,"name"=>$name,"username"=>$username,"email"=>$email,"str"=>$str,"active"=>$active);
                echo "<tr>
                <td>".$row['id']."</td>
                <td>".$name."</td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td><button class='btn ".$active."' onclick='update_user($id_e);'>".$str."</button></td>
                <td>".$row['points']."</td>
                <td>".$row['date_registered']."</td>
                <td><a href='activity_tracker.php?username=".$row['username']."' class='btn btn-primary '>Track</a>&nbsp;&nbsp;<input type='button' value='Request' class='btn btn-primary'/> <a href='user_edit.php?id=".$row['id']."' class='btn btn-primary '>Edit</a></td>
             </tr>
          ";
          
                }
                
                echo '</tbody>
                
              </table>';
              
                //echo json_encode($data);
         
}

if(@$send_notification) {
    $date = date(Y-m-d);
   $sql = mysqli_query($link,"INSERT INTO `notifications`(`title`, `message`, `image`, `date`) VALUES ('".$title."','".$message."','".$full_path."','".$date."')");

	$sql1 = mysqli_query($link,"UPDATE users SET badge = badge +1");
	        header("Location: notification.php");
			setcookie("send_notification","Set Notification Badge Success for All User",time()+1);
}

   /* define('API_ACCESS_KEY','AAAAfC1kR1g:APA91bF41cQPBoIu5Y3rsZWGHFMivNpKpWzPTgpFepvCFaKmV-e0eiuLG7pWUV4USIh1Ts8ECiivZDSHaQxV6RTvVqT7S3g2Jzhg-PA0nUhEhw-IzolFhsTLnsja64pj5ASNPUcKgNRX');
	
	//creating a new push

	if($users == 'all'){
		$sql = mysqli_query($link,"select `fcm_id` from `users` ");
	
		$res = mysqli_fetch_array($sql);
		$fcm_ids = array();
		foreach($res as $fcm_id){
			$fcm_ids[] = $fcm_id['fcm_id'];
		}
	}elseif($users == 'selected'){
		$selected_list = $_POST['selected_list'];
		if(empty($selected_list)){
			$response['error']=true;
			$response['message']='Please Select the users from the table';
			echo json_encode($response);
			return false;
		}
		$fcm_ids = array();
		$fcm_ids = explode(",",$selected_list);
	}
	echo $fcm_ids;
	//$registrationIDs = $fcm_ids;
	$registrationIDs = array_filter($fcm_ids);
	//print_r($registrationIDs);
	// return false;
	
	/*dynamically getting the domain of the app*/
	/*$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url .= $_SERVER['SERVER_NAME'];
	$url .= $_SERVER['REQUEST_URI'];
	$server_url = dirname($url).'/';
	
	$push = null;
	$include_image = (isset($_POST['include_image']) && $_POST['include_image'] == 'on') ? TRUE : FALSE;
	if($include_image){
		// common image file extensions
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = end(explode(".", $_FILES["image"]["name"]));
		if(!(in_array($extension, $allowedExts))){
			$response['error']=true;
			$response['message']='Image type is invalid';
			echo json_encode($response);
			return false;
		}
		$target_path = 'images/notifications/';
		$filename = microtime(true).'.'. strtolower($extension);
		$full_path = $target_path."".$filename;
		if(!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)){
			$response['error']=true;
			$response['message']='Image type is invalid';
			echo json_encode($response);
			return false;
		}
		
	}else{
		
	}
	//$date = date("Y-m-d")
	//$db->sql($sql);
	/*$sql = mysqli_query($link,"INSERT INTO `notifications`(`title`, `message`, `image`) VALUES ('".$title."','".$message."','".$full_path."')";
	//$db->sql($sql);*/
/*	$newMsg = array();
	
	//first check if the push has an image with it
	if($include_image){
		$fcmMsg = array(
			'title' => $title,
			'message' => $message,
			'image' => 'http://wpwala.com/nostragumus/spin/'.$full_path
			//'image' => $server_url.''.$full_path
			//'sound' => "default",
			// 'color' => "#203E78" 
		);
		//print_r($fcmMsg);
		$newMsg['data'] = $fcmMsg;
	}else{
		//if the push don't have an image give null in place of image
		$fcmMsg = array(
			'title' => $title,
			'message' => $message,
			'image' => null
			//'sound' => "default",
			// 'color' => "#203E78" 
		);
		$newMsg['data'] = $fcmMsg;
		//$newMsg = $fcmMsg;
	}

	$registrationIDs_chunks = array_chunk($registrationIDs,1000);
	// print_r($registrationIDs_chunks);
	$success = $failure = 0;
	
	foreach($registrationIDs_chunks as $registrationIDs){
	echo $registrationIDs;
    	$fcmFields = array(
    		// 'to' => $singleID,
    		'registration_ids' => array_values($registrationIDs),  // expects an array of ids
    		'priority' => 'high',
    		'data' => $newMsg
    	);
    	//print_r(json_encode($fcmFields));
    	$headers = array(
    		'Authorization: key=' . API_ACCESS_KEY,
    		'Content-Type: application/json'
    	);
    	 
    	$ch = curl_init();
    	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    	curl_setopt( $ch,CURLOPT_POST, true );
    	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    	$result = curl_exec($ch );
    	curl_close( $ch );
    	$result = json_decode($result,1);
    	$success += $result['success'];
		$failure += $result['failure'];
	}
        	$data = ' <label class="label label-success">'.$result['success'].' user(s) Sent Successfully</label><label class="label label-danger">'.$result['failure'].' user(s) Couldn\'t Send</label><br></br>';
	
	        header("Location: notification.php");
			setcookie("send_notification",$data,time()+1);
	
}*/

if(@$ads_id) {
        
            $sql = mysqli_query($link, "UPDATE admob SET ads_id = '$ads_id', banner = '$banner',full = '$full', reward = '$reward'");
            if($sql) {
            header("Location: profile.php");
			setcookie("admob updated",$data,time()+1);
            }
            
    
    
} 


    
?>