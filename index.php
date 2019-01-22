<?php 
include 'connect.php';
session_start();



$row=mysqli_query($connect,"select ip from blockedip");
	$deny=array();
	while($r=mysqli_fetch_assoc($row))
	{
	$deny[] = $r['ip'];
	}
	if (in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
		$_SESSION['block']=$_SERVER['REMOTE_ADDR'];
    header("location: block.php");
    exit();
	}






if(isset($_POST['sub']))
{
/*$limitps = 10;
$checkdos=false;
if (!isset($_SESSION['first_request'])){
    $_SESSION['requests'] = 0;
    $_SESSION['first_request'] = $_SERVER['REQUEST_TIME'];
}
$_SESSION['requests']++;
if ($_SESSION['requests']>=3 && strtotime($_SERVER['REQUEST_TIME'])-strtotime($_SESSION['first_request'])<=100000){
    //echo '<script>window.alert("DOS Detected")</script>';
	$checkdos=true;
}elseif(strtotime($_SERVER['REQUEST_TIME'])-strtotime($_SESSION['first_request']) > 2){
    $_SESSION['requests'] = 0;
    $_SESSION['first_request'] = $_SERVER['REQUEST_TIME'];
}*/
$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql_users = "SELECT * from user WHERE username = '$username' AND password = '$password' ";
	$result_users = mysqli_query($connect,$sql_users);
	if($result_users!=false){
	if (mysqli_num_rows ($result_users) <=0 )
	{
		$_SESSION['isloggedin']=false;
		//if($checkdos==true)
			//echo '<script>window.alert("DOS Detected")</script>';
		echo '<script>window.alert("Please do not give me incorrect values. Give me actual values to gain access to my amazing resources.")</script>';
		echo "<script>window.open('index.php','_self','')</script>";
	}
	else
	{
		$row_users = mysqli_fetch_assoc($result_users);	
		$_SESSION['username'] = $username;
		$_SESSION['isloggedin']=true;
		//if($checkdos==true)
			//echo '<script>window.alert("DOS Detected")</script>';
		echo"<script>window.open('index.php','_self','')</script>";	
	}
	}
}
?>
<html>
<body>
<center>
<h2 style="margin-top:200px">Login</h2>
	<form id="login" action="" method="Post">
		<label><b>Username: </b></label>
		<input type="text" placeholder="Enter Username" name="username" required><br><br>
		<label><b>Password: </b></label>
		<input type="password" placeholder="Enter Password" name="password" required><br><br>
		<button class="c" type="submit" name="sub">Login</button>
	</form>
	<br><br>
	<a href="registerform.php">Register</a>
	
	
	<br><br><br><br>
	<?php
	if(isset($_SESSION['isloggedin']))
	{
		if($_SESSION['isloggedin'])
		echo "<h2>Welcome, ".$_SESSION['username']."</h2>";
		else
		echo "<h2>Invalid credentials!</h2>";
	}
	?>
	</center>
</body>
</html>