<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/account.css"/>
<title> Account </title>
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
<div id="register_form">
<form action="account.php" method="post" >
	<p>Sign up </p>
  <p>Your email </p>
  <input type="text" name="email" pattern=".{9,50}"   required title="9-50 characters"  > </br>
  <p>Your mobile </p>
  <input type="text" name="mobile" pattern=".{9,50}"   required title="9-50 characters"  > </br>
  <p>Create a password </p>
  <input type="password" name="password" pattern=".{9,50}"   required title="9-50 characters" >
  <p>Repeat password </p>
  <input type="password" name="repeat-password" pattern=".{9,50}"   required title="9-50 characters" >
  <input type="submit" value="register" name="submitreg" >
  </form>

  <?php
  include 'db/db.php';
  if (isset($_COOKIE['id'])) {
      $id    = $_COOKIE['id'];
      $query = mysql_query("SELECT * FROM `users` WHERE `id`='" . $id . "'");
      $work  = mysql_fetch_array($query);
      $hash  = $work['hash'];
      header('Location:' . $base_url . 'order.php');
      exit();
  }

  if (isset($_POST['submitreg'])) {
      $query = mysql_query("SELECT * FROM `users`  WHERE `email`='" . $_POST['email'] . "'");
      $row   = mysql_num_rows($query);

      if ($row > 0) {
          echo "Email has been chosen";
      } else {
          if (!preg_match("/[-a-zA-Z0-9_]{3,20}@[-a-zA-Z0-9]{2,64}\.[a-zA-Z\.]{2,9}/", $_POST['email'])) {
              echo "wrong format of email";
          } elseif ($_POST['password'] != $_POST['repeat-password']) {
              echo "Passwords are not same";
          } else {

              if (strlen($_POST['mobile']) < 11) {
                  echo "Mobile is not correct";
              } else {
                  $query = mysql_query("SELECT * FROM `users` WHERE `mobile`='" . $_POST['mobile'] . "'");
                  $row   = mysql_num_rows($query);
                  if ($row > 0) {
                      echo "Mobile has been chosen";
                  } elseif (preg_match("^[0-9\+\-\(\)\s]+$^", $_POST['mobile'], $out)) {
                      $mobile     = $_POST['mobile'];
                      $password   = $_POST['password'];
                      $email      = $_POST['email'];
                      $activation = md5($email . time());
                      mysql_query("INSERT INTO `users` (`email` ,`password`,`activation`) VALUES('$email','$password', '$activation')");
                      $to      = $_POST['email'];
                      $subject = "Checking Email";
                      $body    = 'Hi, you should activate your link by this link ' . $base_url . 'activation.php?email=' . $activation . '';
                      $headers = 'From: marikovdemezhan.tk' . "\r\n" . 'Reply-To: demezhan1998@gmail.com' . "\r\n" . phpversion();
                      //mail($to, $subject, $body, $headers) or Die();
                      echo "Successfully. Check your email to activate";
                  } else {
                      echo "Unsuccessfully";
                  }
              }
          }
      }
  }


  function generateCode($length = 6)
  {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
      $code  = "";
      $clen  = strlen($chars) - 1;
      while (strlen($code) < $length) {
          $code .= $chars[mt_rand(0, $clen)];
      }
      return $code;
  }


  ?>
 </div>
 <div id="signin_form" >
  <form action="account.php" method="post">
  <p> Sign in</p>
  <p>email </p>
  <input type="text" name="emaile" required >
  <p> password </p>
  <input type="password" name="pass" required ></br>

  <input type="submit" value="sign in" name="submitsin">
  </form>
    <?php
    if(isset($_POST['submitsin']))
       {
           $email=$_POST['emaile'];
           $password=$_POST['pass'];
           $query= mysql_query("SELECT * FROM `users` WHERE `email`='".$email."'");
           $user_data=mysql_fetch_array($query);
           $id=$user_data['ID'];
           if($user_data['password'] == $password )
               {
                   if($user_data['activation']==1)
                   {
                       $hash = md5(generateCode(10));
                       mysql_query("UPDATE  `users` SET  `hash` =  '".$hash."' WHERE  `email`='".$email."'") or die(mysql_error());
                       setcookie("id", $hash ,time() +60*60*24*30, "/");
                       header('Location:'.$base_url.'order.php');
                       exit();
                   }
                   else
                   {
                       echo"Your account did not activated";
                   }
               }
           else
           {
               echo"Wrong password or login";
                       }
       }

  ?>
  </div>

</div>
</ul>
<img src="images/copyright.png" id="copy" >
</body>
</html>
