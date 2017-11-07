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
	
	if (isset($_POST['balance']))
	{
		$search = $_POST['t1'];
		$query6 = "select balance from Numbers_phone where Numbers_phone.number=".$_SESSION['number']."";
		$result6 = mysql_query($query6);
		$row6 = mysql_fetch_array($result6);
		$query7 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance +".$_POST['t1']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
		$result7 = mysql_query($query7);
		$query8 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Пополнение баланса',".$_POST['t1'].",".$_SESSION['number'].")";
		$result8 = mysql_query($query8);
	}
?>

<html>
	<head>
		<meta charset="utf-8">
	<title>Пополнить счет - Личный кабинет МегаФон</title>
	<link rel="shortcut icon" href="image/logo1.png" type="image/x-icon" width="30px">
	<meta charser = "utf-8"/>
	<link href="style.css" rel="stylesheet" type="text/css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="maskedinput.js"></script>

	<script type="text/javascript">
   jQuery(function($){
   $("#number").mask("9?9999");
   });
</script>

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
<a href="lk.php">Главная</a><p>&#8592;Пополнить счёт</p>
</div>

<h1 class="personaldata">Пополнить счёт</h1>

<div id="schet">
<p style="position:absolute; top:20px; left:60px;">Номер телефона:</p>
<?php
echo "<input type='text' value=+7".$_SESSION['number']." disabled style='position:absolute; top:36px; left:200px; height:30px; width:125px; padding:5px; font-size: 16px;'>"
?>
<p style="position:absolute; top:70px; left:60px;">Сумма платежа:</p>
<input type="text" name="t1" id="number" style="position:absolute; top:85px; left:200px; height:30px; width:125px; font-size: 16px;">
<p style="position:absolute; top:76px; left:330px; font-size: 16px;">&#8381;</p> 
<input type="submit" name="balance" value="Пополнить" class="schet">
</div>

</form>
	</body>
</html>