<?php 
include 'connect.php';
session_start();





$limitps = 10;
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
}











	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql_users = "SELECT * from user WHERE username = '$username' AND password = '$password' ";
	$result_users = mysqli_query($connect,$sql_users);
	if($result_users!=false){
	if (mysqli_num_rows ($result_users) <=0 )
	{
		$_SESSION['isloggedin']=false;
		//echo '<script>window.alert("Please do not give me bakwaas values. Give me actual values to gain access to my amazing resources.")</script>';
		//echo "<script>window.open('index.php','_self','')</script>";
	}
	else
	{
		$row_users = mysqli_fetch_assoc($result_users);	
		$_SESSION['username'] = $username;
		$_SESSION['isloggedin']=true;
		echo "Yessssss";
		if($checkdos==true)
			echo '<script>window.alert("DOS Detected")</script>';
		//echo"<script>window.open('index.php','_self','')</script>";	
	}
	}
?>