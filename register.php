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
$limitps = 10;
if (!isset($_SESSION['first_requestr'])){
    $_SESSION['requestsr'] = 0;
    $_SESSION['first_requestr'] = $_SERVER['REQUEST_TIME'];
}
$_SESSION['requestsr']++;
if ($_SESSION['requestsr']>=50 && strtotime($_SERVER['REQUEST_TIME'])-strtotime($_SESSION['first_requestr'])<=2){
    echo '<script>window.alert("SERVICE UNAVAILABLE. Please try later.")</script>';
	$_SESSION['block']=$_SERVER['REMOTE_ADDR'];
	$result=mysqli_query($connect,"insert into blockedip (ip) values ('$_SESSION[block]')");
	echo "ERROR";
	unset($_SESSION['requestsr']); 
	unset($_SESSION['first_requestr']); 
	
	header("location: block.php");
    exit();
	
	
	

} 
	
	
	
	
	
	//echo "DOS DETECTED";
elseif(strtotime($_SERVER['REQUEST_TIME'])-strtotime($_SESSION['first_requestr']) > 2){
    $_SESSION['requestsr'] = 0;
    $_SESSION['first_requestr'] = $_SERVER['REQUEST_TIME'];
}

/*if ($_SESSION['banip']==1) {
    header('HTTP/1.1 503 Service Unavailable');
    die;
}*/












		$Username = $_POST['username'];
		$Name = $_POST['name'];
		$Email = $_POST['email'];
		$Password = $_POST['password'];
		$PhoneNumber = $_POST['phone'];

		$sql_users = "INSERT INTO user(username,name,email,password,phone) VALUES ('$Username','$Name','$Email','$Password','$PhoneNumber')";
		if(mysqli_query($connect,$sql_users))
		{
			//echo "<script>window.alert('Registration successful')</script>";
			if(isset($_SESSION['isloggedin']) && isset($_SESSION['username']))
			{
				unset($_SESSION['isloggedin']);
				unset($_SESSION['username']);
				
			}
			echo "<script>window.open('index.php','_self','')</script>";
			//echo "Value bharli :)";
		}
		else
		{
			//echo "<script>window.alert('Registration unsuccessful')</script>";
			//echo "<a href='index.php' name='a'>Go to Homepage</a>";
		}
?>