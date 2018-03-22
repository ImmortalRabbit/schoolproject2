<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/account.css"/>
<title> Order </title>
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
  <ul class="order">
   <!-- Описание ссылок в меню и сами ссылки. -->
   <li><a href="create-order.php" >Create order</a></li>
   <li><a href="see-orders.php">See orders</a></li>
</ul>


   <div id="titles">

      <?php
	  include('db/db.php');

	  $num=mysql_query("SELECT * FROM `orders` ORDER BY id DESC LIMIT 1 ");
	  $nu=mysql_fetch_assoc($num);
	  $x=$nu['id'];
	  $x=$x+1;
	  $no=0;
	    do
	  {
		  $x=$x-1;

		  $showorder=mysql_query("SELECT * FROM `orders` WHERE `id`='".$x."'");
		  $row=mysql_num_rows($showorder);
		  if($row>0)
		  {
			  $no=$no+1;
		  $show=mysql_fetch_assoc($showorder);
		  $title=$show['titleoforder'];
		  $url=$show['url'];
		  if(strlen($title)>120)
			{
				$title1='';
				$z=-1;
			do
			{
				$z=$z+1;
				$title1=$title1.$title[$z];
			}
			while($z<>120);
			$title=$title1.'...';
			}

		  echo '<p5>'.'<a style="text-decoration:none; color:#F90;"  href="'.$base_url.'order.php?url='.$url.'">'.$no.")".$title.'</a>'.'</p5>'."<br/>";
		  }
		}
		while($x>1);

	  ?>

       </div>
</div>
</ul>
<img src="images/copyright.png" id="copy" >
</body>
</html>
