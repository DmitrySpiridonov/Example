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
	<title>Поддержка - Личный кабинет МегаФон</title>
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

<div id="nav" style="position:absolute; left:430px;">
<a href="lk.php">Главная</a><p>&#8592;Поддержка</p>
</div>

<h1 class="suph1">Поддержка</h1>

<div id="supmenu">
<table>
<tr>

<td width="120"><a href="support.php">
<div id="unpushed1">Частые вопросы</div>
</a></td>

<td width="120">
<div id="pushed1">Консультации по телефону</div></a>
</td>


</td>
</tr>
</table>
</div>

<div id="suptel">
<h2 class="suph2">Консультации по телефону</h2>
<p style="position:absolute; top: 40px; left:20px;">Контактный центр:<br>8 800 550 0500</p>
<p style="position:absolute; top: 40px; left: 200px; width: 260px;">Для звонков с номеров МегаФон:<br>0500</p>
<p style="position:absolute; top: 110px; left: 20px; width: 500px;">При нахождении за пределами Центрального филиала ПАО «МегаФон»<br>+7 920 111 0500</p>
</div>
<hr width=100%; style="position:absolute; top:650px;">
</form>
	</body>
</html>