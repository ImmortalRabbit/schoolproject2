<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/account.css"/>
<title> About us </title>
</head>
<body>
<ul class="navigation">
   <!-- Описание ссылок в меню и сами ссылки. -->
   <li><a href="index.php" >Home</a></li>
   <li><a href="account.php" >Account</a></li>
   <li><a href="see-orders.php" >Order</a></li>
   <li><a href="about-us.php">About us</a></li>
</ul>
<div class="main">

<div id="instr">

</div>
<div id="message" >
<p20> Message </p20>
<form action="about-us.php" method="post">
<?php
	if(!isset($_COOKIE['id']))
	{
		echo'<input type="text" name="email" id="email" placeholder="email" pattern=".{8,100}"  required title="8 characters or more" />';
		echo'<input type="text" name="name" id="name" placeholder="name" pattern=".{3,1000}"  required title="3 characters or more"/>';
	}
?>
<input type="radio" name="typeofmessage" id="errors" value="errors"  /><p21>errors</p21>
<input type="radio" name="typeofmessage" id="advises"  value="advises"/><p22>advises</p22>
<input type="radio" name="typeofmessage" id="questions" value="questions" /><p23>questions</p23>
<input type="radio" name="typeofmessage" id="complaint" value="complaint" /><p24>complaint</p24>
<textarea name="message" id="message"  > </textarea>
<input type="submit" name="send" id="unok" value="send"/>
</form>
<?
	include('db/db.php');
	if(isset($_POST['send']))
	{
		if(isset($_COOKIE['id']))
		{
		$query=mysql_query("SELECT * FROM `users` WHERE `id`='".$_COOKIE['id']."'");
		$boom=mysql_fetch_assoc($query);
		$email=$boom['email'];
		$name=$boom['name'];
		}
		else
		{
			$email=$_POST['email'];
			  if (!preg_match(" /^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i", $email)){
			  		  echo "<p30> wrong format of email </p30>";
			  exit;
			  }

			$name=$_POST['name'];
			 if (!preg_match("/^[a-zA-Zа-яА-Я]+$/ui", $name)) {
				 echo "<p30> name can include only letters </p30>";
			 exit;
				 }
		}
		if(isset($_POST['typeofmessage']))
		{
			$subject=$_POST['typeofmessage'];
		}
		else
		{
			echo "<p30> You did not choose type of message </p30>";
			 exit;
		}

		$to='uphit@mail.ru';
		 if(!isset($_POST['message']))
		   $_POST['message'] = '';
		   $message=htmlspecialchars($_POST['message']);
		   if(!strlen($message)>20)
		   {
			   echo "<p30> too short message </p30>";
			  exit;
		   }
		$body=$message;
		$headers='FROM: '.' '.$email.' '.' NAME: '.$name;
		mail($to, $subject, $body, $headers);
		echo "<p30> Your message was send </p30>";

	}
?>
</div>

</div>
</ul>
<img src="images/copyright.png" id="copy" >
</body>
</html>
