<?php
	session_start();
	require_once('conf.php');


	if ((!isset($_SESSION['id']))&&(!isset($_POST['inputLogin']))) {
		
		include('login.php');
	}
	else {
	
		if(isset($_POST['inputLogin'])){
		$login=$_POST['inputLogin'];
		$clave=md5($_POST['inputPassword']);
		
		$conn=mysql_connect($host.':'.$port, $db_user, $db_pass);
		
		
		if($conn){
		
			$sql="select * from users where login='$login' and pass='$clave' ;";
			
			$db_selected =mysql_select_db($dbname,$conn);
			
			$result = mysql_query($sql, $conn);
			
			$n = mysql_num_rows($result);
			if($n==1){
				$row = mysql_fetch_assoc($result);
				$_SESSION['login']=$row['login'];
				$_SESSION['pass']=$clave;
				$_SESSION['name']=$row['name'];
				$_SESSION['id']=$row['id'];
				
			}
			else{
				echo "<p style=\"color:white\">The user does not exists in the Data Base</p><hr>";
				include('login.php');
			}
		}
		else{
			echo "<p  style=\"color:white\">Can't connect to the Data Base</p><hr>";
			include('login.php');
			}
		}
}
if(isset($_SESSION['id'])){
	require_once('dashboard.php');
}
?>
	