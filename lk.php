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
	<title>Главная - Личный кабинет МегаФон</title>
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


<div id="score">
<h1 class="score">Счет</h1>
<p style="position:absolute; top:30px;">Баланс</p>
<?php
$query2 = "SELECT balance, number FROM Numbers_phone where Numbers_phone.number=".$_SESSION['number']."";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
echo "<p class='balance'>".$row2['balance']."&nbsp;&#8381;</p>";
echo "<p class='number'>+7&nbsp;".$row2['number']."</p>";
?>
<p style="position:absolute; top:80px;">Ваш номер</p>

<a href="balance.php"><img src="image/popolnitchetZ.png" width="150px" style="position:absolute; top:10px; left: 200px;"></a>
<a href="operacii.php"><img src="image/operacii.png" width="300px" style="position:absolute; top:10px; left: 560px;"></a>
<a href="pomochdrugu.php"><img src="image/pomochdrugu.png" width="150px" style="position:absolute; top:10px; left: 380px;"></a>

</div>
<hr width=858px; style="position:absolute; top:280px; left:50px;">
<div id="services">
<h1 class="services">Услуги</h1>
<p style="position:absolute; top:30px;">Тариф</p>
<?php
$query3 = "SELECT name, number FROM Tarifs,Numbers_phone where Tarifs.id_t=Numbers_phone.id_tarif and Numbers_phone.number=".$_SESSION['number']."";
$result3 = mysql_query($query3);
$row3 = mysql_fetch_array($result3);
echo "<p class='balance'>&#171;".$row3['name']."&#187; </p>";
?>

<a href="tarif.php"><img src="image/tarif.png" width="150px" style="position:absolute; top:10px; left: 200px;"></a>
<a href="uslugi.php"><img src="image/services1.png" width="300px" style="position:absolute; top:10px; left: 560px;"></a>
<a href="rouming.php"><img src="image/rouming.png" width="150px" style="position:absolute; top:10px; left: 380px;"></a>
</div>
<hr width=858px; style="position:absolute; top:490px; left:50px;">

<div id="support">
<h1 class="support">Поддержка</h1>
<p style="position:absolute; top:30px;">Служба поддержки поможет в<br> решении ваших проблем и<br> ответит на вопросы</p>

<a href="support.php"><img src="image/support.png" width="330px" style="position:absolute; top:5px; left: 200px;"></a>
</div>
<hr width=858px; style="position:absolute; top:708px; left:50px;">


		</form>
	</body>
</html>