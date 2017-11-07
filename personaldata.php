<?php
session_start();

include "dbcon.php";



if ($_SESSION["is_auth"] !== true && $_SESSION['number'] =='' && $_SESSION['password'] =='')
	{
		header("location:entertoPR.php");
	}
	

if (isset($_POST['exit']))
	{
		@session_destroy();
		session_write_close();
		@session_destroy();
		session_unset();
		session_write_close();
		@session_destroy();
		session_unset();
		echo "<meta http-equiv='refresh' content='0;url=./entertoPR.php';";
	}
?>


<html>
	<head>
		<meta charset="utf-8">
	<title>Персональные данные - Личный кабинет МегаФон</title>
	<link rel="shortcut icon" href="image/logo1.png" type="image/x-icon" width="30px">
	<meta charser = "utf-8"/>
	<link href="style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<form method=POST action="">
			<div id="header">
<div id="logo">
<img src="image/lk1.png" width="40px">
<img src="image/lk2.png" width="230px" class="lk1">
</div>

<div id="PersonalArea">
<input type="submit" name="exit" value="Выход">
</div>

<div id="tagline">
	<a href="index.html">← Перейти на сайт</a>
</div>
<hr>
</div> <!-- Окончание раздела header -->


<div id="fio">		
<?php
$query1 = "SELECT fio, number FROM Abonents, Numbers_phone where Abonents.id=Numbers_phone.id_vlad and Numbers_phone.number=".$_SESSION['number']."";
$result1 = mysql_query($query1);
$row = mysql_fetch_array($result1);
echo "<a href='personaldata.php'><img src='image/chubr.png' width='17px'>&nbsp;&nbsp;&nbsp;".$row['fio']."</a>";
?>		
</div>		

<div id="balance">
<?php
$query2 = "SELECT balance FROM Numbers_phone where Numbers_phone.number=".$_SESSION['number']."";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
echo "<img src='image/balance.png' width='23px'>&nbsp;&nbsp;<p>".$row2['balance']."&nbsp;&#8381;</p>";
?>
</div>

<div id="nav">
<a href="lk.php">Главная</a><p>&#8592;Личные данные</p>
</div>

<h1 class="personaldata">Личные данные</h1>

<div id="personaldata">
<img src="image/140.png" style="position:absolute; top:35px; left:45px;" />
<p style="position:absolute; top:30px; left:240px;">Ваше имя:</p>
<?php
$query4 = "SELECT fio, email, adress, birthday FROM Abonents, Numbers_phone where Abonents.id=Numbers_phone.id_vlad and Numbers_phone.number=".$_SESSION['number']."";
$result4 = mysql_query($query4);
$row4 = mysql_fetch_array($result4);
echo "<p style='font-size:18px; position:absolute; top:22px; left: 360px;'>".$row4['fio']."</p>";
echo "<p style='font-size:18px; position:absolute; top:62px; left: 360px;'>".$row4['email']."</p>";
echo "<p style='font-size:18px; position:absolute; top:103px; left: 360px;'>".$row4['birthday']."</p>";
echo "<p style='font-size:18px; position:absolute; top:136px; left: 360px;'>".$row4['adress']."</p>";
?>
<p style="position:absolute; top:60px; left:240px;">Электронный<br>адрес:</p>
<p style="position:absolute; top:110px; left:240px;">Дата рождения:</p>
<p style="position:absolute; top:143px; left:240px;">Контактный<br>адрес:</p>
</div>
<hr width=400px; style="position:absolute; top:380px; left:580px;">
<p style="position:absolute; top:400px; left:385px; font-style:italic;">Переоформить договор на другое лицо путем изменения личных данных в личном<br>кабинете нельзя, для осуществления данной процедуры необходимо прийти в салон<br>обслуживания.</p>
<p style="position:absolute; top:470px; left:385px; font-style:italic;">Изменение личных данных в настройках личного кабинета не влечет переоформление<br>номера на другое лицо.
<?php
$query5 = "SELECT fio, number from Abonents, Numbers_phone where Abonents.id=Numbers_phone.id_vlad and Numbers_phone.number=".$_SESSION['number']."";
$result5 = mysql_query($query5);
$row5 = mysql_fetch_array($result5);
echo "<p style='position:absolute; top:525px; left:385px; font-style:italic;'>Номер +7".$row5['number']."&nbsp;по-прежнему остаётся зарегистрированным на абонента<br>&#171;".$row['fio']."&#187;. </p>";
?>

<hr width=100%; style="position:absolute; top:800px; left:580px;">


		</form>
	</body>
</html>