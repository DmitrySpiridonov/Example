<?php
@session_start();

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
	echo "<div id='operacii'>";


	$query9 = "Select date, sum, type from Operations where Operations.number_ph=".$_SESSION['number']." order by date desc limit 10";
		$result9 = mysql_query($query9);
		
	
	echo "<table class='table'><tr align='center'><td><b>Дата операции</b></td><td><b>Сумма</b></td><td><b>Тип операции</b></td></tr>";
							while ($row9=@mysql_fetch_array($result9))
							{
								echo "<tr align='center'><td>".$row9['date']."</td><td>".$row9['sum']."</td><td>".$row9['type']."</td></tr>";
							}
							echo "</table>";
	echo "</div>";
	
?>

<html>
	<head>
		<meta charset="utf-8">
	<title>Расходы - Личный кабинет МегаФон</title>
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

<div id="nav" style="position:absolute; left:440px;">
<a href="lk.php">Главная</a><p>&#8592;Операции</p>
</div>

<h1 class="oper">Операции по номеру</h1>

</form>
	</body>
</html>