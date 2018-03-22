<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/account.css"/>
<title> Forum </title>
</head>
<body>

<ul class="navigation">
   <!-- Описание ссылок в меню и сами ссылки. -->
   <li><a href="index.php" >Home</a></li>
   <li><a href="account.php" >Account</a></li>
   <li><a href="see-orders.php" >Order</a></li>
   <li><a href="about-us.php" >About us</a></li>
</ul>

<div class="main">
  <ul class="order">
   <!-- Описание ссылок в меню и сами ссылки. -->
   <li><a href="create-order.php" >Create order</a></li>
   <li><a href="see-orders.php" >See orders</a></li>
</ul>

	<form action="create-order.php" method="post">
     <textarea name="explain"  placeholder="full details of order" required></textarea>
     <input type="text" name="title" id="title" size="64"  pattern=".{40,160}"  required title="40-160 characters" placeholder="short title of order"  >
     <input type="submit" name="create" id="create" value="create">
     <p4>
<?php

	 include('db/db.php');

	 if (isset($_COOKIE['id']))
	{
		$id=$_COOKIE['id'];
		$query=mysql_query("SELECT * FROM `users` WHERE `hash`='".$id."'");
		$work=mysql_fetch_array($query);

	}
  else{
    header('Location:'.$base_url.'order.php');
    exit();
  }
	 if(isset($_POST['create']))
	 {
		 $author=$work['email'];
		 $title=$_POST['title'];
		 $query = mysql_query("SELECT * FROM `orders`  WHERE `titleoforder`='".$title."'");
								$rows = mysql_num_rows($query);
								if($rows > 0)
								{
								echo "Title is exist";
								}
								else
								{
		 $explain=$_POST['explain'];
		 $query = mysql_query("SELECT * FROM `orders`  WHERE `explanation`='".$explain."'");
								$row = mysql_num_rows($query);
								if($row > 0)
								{
									echo "order's details is already exist";
								}
								else
								{
		 $url=md5($title.$explain);
		  mysql_query("INSERT INTO `orders`(`titleoforder`,`explanation`,`author`,`url`) Values('$title','$explain','$author','$url')");
		 echo "Your order have created";
		}
								}
	 }

	 ?> </p4>
     </form>


</div>

<img src="images/copyright.png" id="copy" >
</body>
</html>
