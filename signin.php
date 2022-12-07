<?php 
require_once 'actions/dbcon.php';

session_start();

if (isset($_SESSION['userid'])) {
    header('location:'.$store_url.'home.html');
}
$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$upass = $_POST['upass'];

	if(empty($username) || empty($upass)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($upass == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$upass = md5($upass);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$upass'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['userid'];

				// set session
				
				$_SESSION['userId'] = $user_id;

				header('location:'.$store_url.'choice.html');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username does not exists";		
		} // /else
	} // /else not empty username // password
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="shortcut icon" type="x-icon" href="RESOURCES/center_logo.png">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
*{
    margin:0;
    padding:0;
    font-family: 'Poppins', sans-serif;
}

body{
   background-image: url('RESOURCES/bg_header.jpg');
   background-repeat: no-repeat;
   background-attachment: center center;
   background-size: cover;
   width: 100%;
}

.container{
    position: relative;
    color:white;
    background: rgba(15, 24, 31, 0.438);
   
    

}
.input-container * {
    box-sizing: border-box;
}
.input-container {
    position: relative;
    width: 300px;
}
.input-container label {
    position: absolute;
    left: 10px;
    top: 14px;
    transition: .2s;
    z-index: 1;
    color: #ffffff;
    font-family: poppins;
    font-size: 16px;
    cursor: text;
}
.input-container input {
    padding: 0.8rem;
    width: 100%;
    height: 100%;
    border: 2px solid #ffffff;
    background: rgb(0, 0, 0, 0);
    outline: none;
    border-radius: 5px;
    font-size: 16px;
    transition: .3s;
    color: #fff;
    border: 1px solid #ffffff;
}
.input-container label:before {
    content: '';
    
    height: 5px;
    background: #2B2B2B; 
    position: absolute;
    left: 0;
    top: 10px;
    width: 100%;
    z-index: -1;
}
.input-container input:not(:placeholder-shown),
.input-container input:focus {
    border: 3px solid #ffffff;
    
}
.input-container input:not(:placeholder-shown) + label,
.input-container input:focus + label {
    top: -10px;
    color: #ffffff;
    font-size: 14px;
    
    
}
.input-container input::placeholder {
    font-size: 16px;
    opacity: 0;
    transition: .3s;
    
}
.input-container input:focus::placeholder {
    opacity: 1;
}
.button {
    background-color: #fbaf03;
    border: none;
    color:#ffffff;
    font-family: Poppins Extrabold;
    font-size: 10px;
    border-radius: 5px;
    width: 300px;
    height: 50px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    transition-duration: 0.4s;
}

.line a{
    text-decoration: none;
    color:#fbaf03;
    cursor: pointer;
}
.messages {
    background: #f2dede;
    color: #a94442;
    width: 95%;
    border-radius: 5px;
}
</style>
<body>
    <center>
<form action="" method="POST" id="loginForm">
    <div class="container">
    <div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>
        <br><br>
        <img src="RESOURCES/center_logo.png" width="150px">
        <p style="font-weight: 800; font-size:30px; margin-top: -20px;">Welcome Back</p>
        <p style="font-weight:300; font-size:15px;">Please Input your Credentials</p>
        <br>
        <div class="input-container">
            <input type="text" id="username" name="username" placeholder="Enter your username" required/>
            <label class="label" for="username">Username</label>
        </div>
        <br>
        <div class="input-container">
            <input type="password" id="upass" name="upass" placeholder="Enter your Password" required/>
            <label class="label" for="upass">Password</label>
        <script>
            function myFunction() {
              var x = document.getElementById("upass");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script> 
        </div>
        
        <input type="checkbox" onclick="myFunction()"style="margin-left:-160px; margin-top:10px;"> Show Password
        <br>
        <a href="choice.html"><button class="button" type="submit">LOG IN TO YOUR ACCOUNT</button></a>
        </form>
        <div class="line">
            <table>
                <td><p style="font-family: sans-serif;">_______&nbsp;&nbsp;&nbsp;</p></td>
                <td><p style="margin-top:8px ;">or</p></td>
                <td><p style="font-family: sans-serif;">&nbsp;&nbsp;&nbsp;_______</p></td>
            </table>
        
            <table>
                <td><p>Create your Account?</p></td>
                <td><a href="signup.php"> Sign Up</a></td>
            </table>
        
        </div>
    </div>
</center>
</body>
</html>