<?php
include "dbcon.php";
if(isset($_POST['s1']))
	{
		$search = $_POST['t1'];
		$search1 = $_POST['t2'];
		$query1 = "SELECT * FROM Numbers_phone where number='$search' and password='$search1'";
		$result1 = mysql_query($query1);
		

	$num_rows = mysql_num_rows($result1);
	if ($num_rows == 1)
		{ 
			echo "<meta http-equiv='refresh' content='0;url=./lk.php';";
			session_start();
			$_SESSION['is_auth'] = true;
			$_SESSION['number'] = $search;
			$_SESSION['password'] = $search1;
		}
	else
		{
			echo "<p style='color:red; position:absolute; top:350px; left:420px; font-size:12px; z-index:1;'>Неверно указан номер телефона или пароль!</p>";
		}

	}
	mysql_close($is_connected);
?>
<html>
<head>
<title>Вход в личный кабинет</title>
<link rel="shortcut icon" href="image/logo1.png" type="image/x-icon" width="30px">
<meta charset = "utf-8"/>
<link href="style.css" rel="stylesheet" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="maskedinput.js"></script>

	<script type="text/javascript">
   jQuery(function($){
   $("#phone").mask("9999999999");
   });
</script>

</head>

<body>
<form name="f1" method=POST action="">
<div id="header">
<div id="logo">
<a href="index.html"><img src="image/logo.png" width="150px" alt="На главную"></a>
</div>
<div id="tagline">
	<p>«По-настоящему рядом»</p>
</div>
<hr>
</div> <!-- Окончание раздела header -->

<div id="enterform">
<h2 style="position:absolute; top:10px; left:20px; color:rgb(53, 167, 110); font-family: 'Trebuchet MS', Helvetica, sans-serif; text-shadow: 0.1px 0.1px 0.1px black;">Вход</h2>
<p style="position:absolute; top:50px; left:20px; font-family: 'Trebuchet MS', Helvetica, sans-serif;">Номер телефона</p>
<input type="text" name="t1" id="phone" class="t1" placeholder="9ХХХХХХХХХ" class="input1">
<p style="position:absolute; top:110px; left: 20px; font-family: 'Trebuchet MS', Helvetica, sans-serif;">Пароль</p>
<input type="password" name="t2" class="t2">
<input type="submit" name="s1" class="s1" value="Войти">
	<div id="enterform1">
		<h3>Как получить пароль?</h3>
		<p style="position:absolute; top:50px; margin-left:40px;">Пароль для входа в личный кабинет вы получаете при регистрации SIM-карты.</p>
		<p style="position:absolute; top:110px; margin-left:40px;">В случае его утраты введите с клавиатуры устройства запрос *105*00#<p>
	</div>
</div>
</form>
</body>
</html>