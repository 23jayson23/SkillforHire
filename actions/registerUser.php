<?php 	

require_once 'dbcon.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$userName 		= $_POST['fullname'];
  $upassword 			= md5($_POST['pass']);




				$sql = "INSERT INTO users (username, password)
				VALUES ('$userName', '$upassword')";
				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";
						
				
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			
		
	} // if in_array 		
    
	$connect->close();
	

	echo json_encode($valid);
 
