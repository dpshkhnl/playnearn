<?php include('db.php');


$key = "6808";

extract($_REQUEST);

//01. SING UP
if(isset($user_signup) && isset($access_key)) {
    $response = array();
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	

	$check_exits_user_query = "select username,email,phone from users where username='$username' or phone='$phone' or email='$email'";
		$send_sql = mysqli_query($link,$check_exits_user_query);
		
	if(mysqli_num_rows($send_sql)==1){
		$response['error'] = "true";
		$response['message'] = "Username or Email is already registered! Please Login";
		print_r(json_encode($response));
	return false;
	}
		
	$pwd = md5($password);
   
	$register_user = "INSERT INTO users (name,username,password,email,fcm_id,points,refer,ip_address,phone) VALUES ('$name','$username','$pwd','$email','$fcm_id','$points', '$refer','$ip_address','$phone')";
	$send_server= mysqli_query($link,$register_user);
	
	if($send_server){
	    $response['error'] = false;
		$response['message'] = "User Registered successfully";
		$response['id'] = mysqli_insert_id($link);
	}else{
	    $response['error'] = true;
	    $response['message'] = "Please fill all the data and submit!";
	}
	print_r(json_encode($response));
}
//01. Login
if(isset($user_login) && isset($access_key)) {
   
    $response = array();
  
    if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$pwd = md5($password);

	$user_query = "select * from users where username='$username' and password='$pwd'";
	$sql = mysqli_query($link,$user_query);
	$data = mysqli_fetch_assoc($sql);
	if(mysqli_num_rows($sql)==1){
		
				if(isset($refer) && !empty($refer)) {
			    $refer_query = mysqli_query($link, "SELECT * FROM users WHERE refer='$refer' and username!='$username'");
			    $get_refer_status = mysqli_fetch_assoc($refer_query);
			    if(mysqli_num_rows($refer_query)==1){
			            $check_status = mysqli_query($link, "SELECT refer_status FROM users WHERE username = '$username'");
			            $get_refered = mysqli_fetch_assoc($check_status);
			            if($get_refered['refer_status']==0) {
			            $response['refer_code_status'] = "Referral code is valid";
						$response['refer_code_error'] = "false";
						$response['refer_id'] = $get_refer_status['id'];
						$response['refer_username'] = $get_refer_status['username'];
						
						$refer_point = "UPDATE `users` SET `points`= `points`+500 WHERE id=".$get_refer_status['id'];
						$db = mysqli_query($link,$refer_point);
						
						//adding tracking record
						$adding_tracking_record = 'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$get_refer_status['username'].'","500","Refer & Earn","'.date('Y-m-d').'")';
						$db = mysqli_query($link,$adding_tracking_record);
						
						//setting the refer_status of user who is claiming the points to 1
						$user_get_points = "UPDATE `users` SET `refer_status`= 1 WHERE username='".$username."'";
						$db = mysqli_query($link,$user_get_points);
			            } else {
			                
			            $response['refer_code_status'] = "You've already redeemed the points";
						$response['refer_code_error'] = "true";
			            }
			        
			    } else {
			        	$response['refer_code_status'] = "Invalid Referral Code";
					    $response['refer_code_error'] = "true";
			    }

			}
			$str = mysqli_query($link,"SELECT * FROM admob");
			$res = mysqli_fetch_assoc($str);
			$response['error'] = "false";
			$response['message'] = "Successfully logged in";
			$response['data'] =$data+$res;

	} else {
    
	    	$response['error'] = "true";
			$response['message'] = "Wrong username / password! Try Again";
	}

	print_r(json_encode($response));
}

//3. add_spin - Add Spin Points to user account and add the tracking activity
if(isset($access_key) && isset($add_spin)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	if($type == 'Daily checked In' || $type == 'Daily checkin bonus'){
		$date = date('Y-m-d');
    	$sql= mysqli_query($link,"SELECT * FROM `tracker` where (`type`='Daily checkin bonus' or `type`='Daily checked In') and `username` = '$username' and date(`date`)='".date('Y-m-d')."'");
		$res = mysqli_fetch_assoc($sql);
		if(mysqli_num_rows($sql)>0) {
			$response['error'] = "true";
			$response['message'] = "You've already claimed daily bonus";
			print_r(json_encode($response));
			return false;
		}
		
	}     
	    $date = date("Y-m-d");
		if(!empty($username) && !empty($type)){
		    $date = date('Y-m-d');
		    //Add Data Tracker
		    $tracker_query = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$username.'","'.$points.'","'.$type.'","'.date('Y-m-d').'")');
		    $result = mysqli_insert_id($link);
		    //Update User Points
		    $update_user_points = mysqli_query($link,"UPDATE `users` SET `points` = `points` + '".$points."' WHERE `users`.`username` ='".$username."'");
		    
		    $response['error'] = false;
		    $response['message'] = "Points added to your wallet";
	    	$response['id'] = $result;
		} else {
		    	$response['error'] = true;
	        	$response['message'] = "Please fill all the data and submit!";
		}
	
	print_r(json_encode($response));
}

//4. payment_request - Payment request by the user
if(isset($access_key) && isset($payment_request)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$select_user = mysqli_query($link,"SELECT * FROM payment_requests WHERE username='$username' AND status = 0");
	
	if(mysqli_num_rows($select_user)>=1){ 
    		$response['error'] = true;
			$response['message'] = "You Already Requested";
	} else {
 	   $add_request = mysqli_query($link, 'INSERT INTO `payment_requests`(`username`, `payment_address`, `request_type`, `request_amount`, `points_used`, `remarks`, `status`,`date`) VALUES 
							("'.$username.'","'.$payment_address.'","'.$request_type.'","'.$request_amount.'","'.$points_used.'","'.$remarks.'","'.$status.'","'.date('Y-m-d').'")');
   	    $result = mysqli_insert_id($link);
	    $sql = mysqli_query($link,"UPDATE `users` SET `points` = '0' WHERE `users`.`username` ='".$username."'");
   
	        $response['error'] = false;
			$response['message'] = "Request has been registered successfully";
			$response['request_id'] = $result;
     
	}

	print_r(json_encode($response));
}

// 5. get_user_by_id() - get login details by user's username
if(isset($access_key) && isset($get_user_by_id)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"SELECT * FROM `users` WHERE id='$id'");
		$result = mysqli_fetch_assoc($sql);
		if(mysqli_num_rows($sql)>0) {
		    $response['error'] = "false";
			$response['data'] = $result;
		} else {
		    $response['error'] = "true";
			$response['message'] = "No data found!";
		}
		
	print_r(json_encode($response));
}

// 6. forget_password() - get login details by user's username
if(isset($access_key) && isset($forget_password)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email'");
		$result = mysqli_fetch_assoc($sql);
		if(mysqli_num_rows($sql)>0) {
		    
			$random = rand(100000,999999);
			$from = "no-reply@khela.com";
			$to = $email;
			$subject = "Password has been Reset by you | Khela App ";
			$text = "Hello Dear user, your password for Khela App has been reset by you. Please login via following password now. ";
			$text .= "<br>New Password : <b>".$random."</b>";
			$text .= "<br><br>Please login via following password now. <br>This password was reset by you using forgot password option<br><br><b>Khela App</b>";
			$header = "From: Password has been reset | Khela App<$from>\r\nReply-to: $from\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$send =mail($to,$subject,$text,$header);
			if($send){
			   $sql = mysqli_query($link,"UPDATE `users` SET `password`='".md5($random)."' WHERE `email`='".$email."'");
		  		$response['error'] = "false";
			    $response['message'] = " Password has been reset and mailed to your Email. Please check the inbox";
		   
			}else{
			    $response['error'] = "true";
			    $response['message'] = "Password could not be reset! Try again!";
			}
			
			
        }else {
    	    $response['error'] = "true";
			$response['message'] = "Invalid email address! Enter correct email address!";
        }
        
        print_r(json_encode($response));
}

// 7. set_refer_status() - set the refer status if referral code redemption is done
if(isset($access_key) && isset($set_refer_status)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
		    $sql = mysqli_query($link,"UPDATE `users` SET `refer_status`='".$refer_status."' WHERE `email`='".$email."'");
			$response['error'] = "false";
	        $response['message'] = " Refer Status set successfully";
	print_r(json_encode($response));
}
// 8. get_refer_status() - get the refer status to check if referral code redemption is done
if(isset($access_key) && isset($get_refer_status)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"select `refer_status` from `users` WHERE `email`='".$email."'");
		$result = mysqli_fetch_assoc($sql);
		$response['error'] = "false";
    	$response['refer_status'] = $result['refer_status'];
	    print_r(json_encode($response));
}

// 9. update_profile() - update user profile

if(isset($access_key) && isset($update_profile)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "UPDATE `users` SET `name`='".$name."'";
	$sql .= (isset($password) && !empty($password))?" ,`password`='".md5($password)."'":"";
	$sql .= " WHERE `username`='".$username."'";
	$run = mysqli_query($link,$sql);
	if($run){
	$response['error'] = "false";
	$response['message'] = " Profile updated successfully";
	}else {
	    $response['error'] = "true";
	    $response['message'] = " Profile Not Upateded! Try Again";
	}
	print_r(json_encode($response));
	
	
}
// 10. user_tracker() - get login details by user's username
if(isset($access_key) && isset($user_tracker)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
		$sql = mysqli_query($link,"SELECT MAX(id) as id,date FROM `tracker` WHERE username='".$username."' and points=0 and type='claim'");
		$result = mysqli_fetch_assoc($sql);
		
		if(empty($result) || $result['id'] == ''){
			$sql = mysqli_query($link,"SELECT Min(id) as id,date FROM `tracker` WHERE username='".$username."'");
			$result = mysqli_fetch_assoc($sql);
		}
		
		$id = $result['id'];
		$date = date('d-M-Y', strtotime($result['date']));
		$sql = mysqli_query($link,"SELECT * FROM `tracker` where id >= '".$id."' and `username`='".$username."' ORDER BY `id` DESC");
		$rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
		
		if (!empty($rows)) {
			$response['error'] = "false";
			$response['message'] = "Tracking history from ".$date." onwards";
			$response['data'] = $rows;
		}else{
			$response['error'] = "true";
			$response['message'] = "No tracking history found!";
		}
		
	print_r(json_encode($response));
}

//3. daily_checkin - Daily checkin of user and Add Spin Points to user account
if(isset($access_key) && isset($daily_checkin)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
		$sql = mysqli_query($link,"select id from tracker where `username`='".$username."' and (`type`='Daily checkin bonus' or `type`='Daily checked In') and date(`date`)='".date('Y-m-d')."'");
		$result = mysqli_fetch_assoc($sql);
		
		if(mysqli_num_rows($sql)>0){
		    
			$response['error'] = false;
			$response['message'] = "You've already claimed your daily checkin bonus!";
			$response['id'] = $result['id'];
			print_r(json_encode($response));
			return false;
		}
            $tracker_query = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$username.'","'.$points.'","'.$type.'","'.date('Y-m-d').'")');		
			$sql = mysqli_query($link,"UPDATE `users` SET `points` = `points` + '".$points."' WHERE `users`.`username` ='".$username."'");
	        $result = mysqli_fetch_assoc($tracker_query);	
		
		    $response['error'] = false;
	    	$response['message'] = "Points added to your wallet";
	    	$response['id'] = $result['id'];
	    	print_r(json_encode($response));
}
// 12. get_payment_requests() - get user's payment requests 
if(isset($access_key) && isset($get_payment_requests)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
    	$sql = mysqli_query($link,"SELECT * FROM `payment_requests` WHERE username='$username'");
	
	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

		if (!empty($row)) {
			$response['error'] = "false";
			$response['data'] = $row;
		}else{
			$response['error'] = "true";
			$response['message'] = "No data found!";
		}
	
		print_r(json_encode($response));
}
// 13. update_fcm_id() - update user's fcm id
if(isset($access_key) && isset($update_fcm_id)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"UPDATE `users` SET `fcm_id`='".$fcm_id."' WHERE `username`='".$username."'");
	$response['error'] = "false";
	$response['message'] = "FCM ID updated successfully";
	print_r(json_encode($response));
}
///

//14. Join Draw Game
if(isset($_POST['access_key']) && isset($_POST['join_draw'])){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	if(!empty($username) && !empty($type)){
	
	    $adding_tracking_record = mysqli_query($link,'INSERT INTO `tracker`(`username`, `points`, `type`, `date`) VALUES 
							("'.$username.'","'.$points.'","'.$type.'","'.date('Y-m-d').'")');

		
		$sql = mysqli_query($link,"UPDATE `users` SET `points` = `points` + '".$points."' WHERE `users`.`username` ='".$username."'");
		
		/* Lucky Draw Table Joining Update +1 User Joined*/
		
		$sql = mysqli_query($link,"UPDATE `lucky_draw` SET `total_user` = `total_user` + 1 WHERE `lucky_draw`.`id` ='".$game_id."'") ;
		
	    /* Insert Join User Data to My_Contest Table to Remember user Details his joined*/
	    
	  	$sql = mysqli_query($link,'INSERT INTO `my_contests`(`game_id_name`, `game_name`, `username`,`game_email`,`game_result_date`,`game_prize`) VALUES 
							("'.$game_id.'","'.$game_name.'","'.$username.'","'.$game_email.'","'.$game_result_date.'","'.$game_prize.'")');
	
		
		$response['error'] = false;
		$response['message'] = "Registerd Successfuly";
		$response['id'] = mysqli_insert_id[$link];
	}else{
		$response['error'] = true;
		$response['message'] = "Please fill all the data and submit!";
	}
	print_r(json_encode($response));
}

if(isset($access_key) && isset($get_luckydraw_list)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
        if($fcm_id) {
        $sql = mysqli_query($link,"UPDATE `users` SET `fcm_id` = '".$fcm_id."' WHERE `users`.`email` ='".$email."'");
        }
        $sql=mysqli_query($link,"select * from lucky_draw");
        
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
       // print json_encode($rows);
        echo json_encode((['feed' => $rows]));
       
}
// Get My Lucky Draw List////////////////////////////////////
if(isset($access_key) && isset($my_contests)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
        
     $sql=mysqli_query($link,"SELECT * FROM my_contests WHERE username = '$username'");
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
       // print json_encode($rows);
        echo json_encode((['feed' => $rows]));
 
}

// Get Game List////////////////////////////////////
if(isset($access_key) && isset($my_game)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
         $sql=mysqli_query($link,"select * from game_list");
        
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
       echo json_encode((['feed' => $rows]));

}
////// get UPI
if(isset($access_key) && isset($upi)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

        $sql=mysqli_query($link,"select upi_name,upi_id from admin");
       
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
       echo json_encode((['feed' => $rows]));
 
}

// Lucky Draw Result////////////////////////////////////
if(isset($access_key) && isset($contest_result)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

         $sql=mysqli_query($link,"select * from draw_result where game_name = '$game_name'");
       
        
        //////
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
       // print json_encode($rows);
        echo json_encode((['feed' => $rows]));
   
}

//////////////// GetActivity Data

if(isset($access_key) && isset($activity)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
         $sql = mysqli_query($link,"SELECT * FROM notifications ORDER BY id DESC");
         //////
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

        echo json_encode((['feed' => $rows]));
}

// Insert Paid or Free Game Statics
if(isset($access_key) && isset($count_play)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	    if($free_game) {
	        $sql = mysqli_query($link,"UPDATE game_list SET free = free+1 WHERE id = '$id'");
	    } else {
	        $sql = mysqli_query($link,"UPDATE game_list SET paid = paid+1 WHERE id = '$id'");
	    }
         
         //////
        $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }

        echo json_encode((['feed' => $rows]));
}

/// Get Leaderboad
if(isset($access_key) && isset($leaderboad)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT points FROM users ORDER BY points DESC limit 10");
	
	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
        echo json_encode((['feed' => $rows]));
        
}
//get Admob Id
if(isset($access_key) && isset($admob)){

	if($key != $access_key){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = mysqli_query($link,"SELECT * FROM admob");
	
	    $rows = array();
        while($r = mysqli_fetch_assoc($sql)) {
         $rows[] = $r;
        }
        echo json_encode((['feed' => $rows]));
        
}
?>


