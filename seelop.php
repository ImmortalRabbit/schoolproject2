<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>

<center>
<p>
	   <?php 
		include'db/db.php';
		if (isset($_COOKIE['id']))
	{
		$id=$_COOKIE['id'];
		$query= mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'");
		$work=mysql_fetch_array($query);
		$hash=$work['hash'];
		header('Location:'.$base_url.'profile.php?junk='.$hash.''); 
		exit();
	}
	else
	{
  
		if(isset($_GET[show]))
		{
	     	$check=$_GET[show];
			$query= mysql_query("SELECT `login`,`password` FROM `users` WHERE `hash`='".$check."'") or die(mysql_error());
			$work=mysql_fetch_assoc($query);
			$log = $work['login'];
			$pass = $work['password'];
			echo " LOGIN - ".$log.""; 
			echo " PASSWORD - ".$pass."";
			
		}
		else
		{
			header('Location:index.php'); 
		}
	}
			?>
  </p>
  </div>	
</center>    
  <style>
  p
  {
	  font-family:"Comic Sans MS", cursive;
	  font-size:36px;
  }
  </style>  
</body>
</html>