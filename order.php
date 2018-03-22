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
   <li><a href="account.php">Account</a></li>
   <li><a href="see-orders.php" >Order</a></li>
   <li><a href="about-us.php" >About us</a></li>
</ul>

<div class="main">

<?

include('db/db.php');


if(!isset($_GET['url']))
{
    header('Location:'.$base_url.'see-orders.php');
    exit();
}
else{
  	$url=$_GET['url'];
		$query=mysql_query("SELECT * FROM `orders` WHERE `url`='".$url."'");
		$boom=mysql_fetch_assoc($query);
		$title=$boom['titleoforder'];
		$explain=$boom['explanation'];
		$author=$boom['author'];
		$id=$boom['id'];
		$query1=mysql_query("SELECT * FROM `users` WHERE `email`='".$author."'") or mysql_error();
		$boom1=mysql_fetch_assoc($query1);
		$mobile=$boom1['mobile'];
    echo "№$id: $title";
		echo "<br />";
		echo "<div6>$explain</div6><br />";
		echo '<p7>Author:<a style="text-decoration:none; color:#F90;" href="'.$base_url.'profile.php?junk='.$junk.'">'.$author.'</a></p7>';


}
?>

</div>

<img src="images/copyright.png" id="copy" >
</body>
</html>
