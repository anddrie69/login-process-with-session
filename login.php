<?php
	ob_start();
	include "lib/confiq.php";
	$username=$_POST['user'];
	$password=$_POST['pass'];
	
	mysql_select_db(database_name,$conect);
	if(($username!="") && ($password!=""))
	{
		$query_login = "select * from user where user = '$username' and pass = '$password'";
		
		$login = mysql_query($query_login,$conect) or die (mysql_error());
	
		$row_login = mysql_fetch_assoc($login);
	
		do{
	
		if(($username==$row_login['user']) && ($password==$row_login['pass']))
		{
			session_start();
			session_register('user');
			session_register('pass');
			header("location:admin/index.php");
		}
		else
		{
			echo "<script>alert('Password is wrong!');location.href='index.php'</script>";
		}
		}while ($row_login = mysql_fetch_assoc($login));
	}
		else
		{
			echo"<script>alert('Your form is empty');location.href='index.php'</script>";
		}	
