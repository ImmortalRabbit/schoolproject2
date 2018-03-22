
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
<title> Activation code </title>
</head>
<body>

<center>
<div id="login">
  <p>
	   <?php

	include'db/db.php';


		if(isset($_GET['email']))
		{
				$activate = $_GET['email'];
				$c=mysql_query("SELECT id FROM `users` WHERE `activation`='".$activate."'");
				$r=mysql_num_rows($c);
							if($r > 0)
							{
								$count=mysql_query("SELECT * FROM `users` WHERE `activation`='".$activate."'");
								$h=mysql_num_rows($count);
															if($h = 1)
															{
																mysql_query("UPDATE  `users` SET  `status` =  '1' WHERE  `activation`='".$activate."'");
																echo "Your account activated";

															}
															else
															{
																 echo "Your account does not activated";
															}

							}
							else
							{
								echo "Activation code is incorrect";
							}
		}
		else
		{
		if(isset($_GET['old']))
		{

			if(isset($_GET['activate']))
			{
				$old = $_GET['old'];
							$activation=md5($old.time());
			mysql_query("UPDATE `users` SET `status`='0' WHERE `activation`='".$_GET['activate']."'");
			mysql_query("UPDATE `users` SET `email`='".$old."' WHERE `activation`='".$_GET['activate']."'");
			mysql_query("UPDATE `users` SET `activation`='".$activation."' WHERE `activation`='".$_GET['activate']."'");

												$to=$old;
												$subject="Checking Email";
												$body='Hi, you should activate your link by this link '.$base_url.'activation.php?email='.$activation.'';
												$headers = 'From: marikovdemezhan.tk' . "\r\n" .
												'Reply-To: demezhan1998@gmail.com' . "\r\n" .phpversion();
												mail($to, $subject, $body, $headers) or Die();
													 echo "Message send to your new email";
													 echo $old;
		}
		else
		{
			header('Location:index.php');
		}

		}
		else
		{
			header('Location:index.php');
	}
		}

			?>
  </p>
  <p> <il> <a href="index.php">HOME</a> </il>
  </div>
</center>

</body>
</html>
