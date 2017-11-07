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
	<title>Тарифы - Личный кабинет МегаФон</title>
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
<a href="lk.php">Главная</a><p>&#8592;Тарифы</p>
</div>

<h1 class="personaldata">Тарифы</h1>
<div id="personaldata">
<h2 style="color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:-10px;">Текущий тарифный план</h2>
<?php
$query13 = "SELECT name, number, balance FROM Tarifs,Numbers_phone where Tarifs.id_t=Numbers_phone.id_tarif and Numbers_phone.number=".$_SESSION['number']."";
$result13 = mysql_query($query13);
$row13 = mysql_fetch_array($result13);
$query14 = "Select name, abon_plata, st_podkl, opisanie from Tarifs, Numbers_phone where Tarifs.id_t=Numbers_phone.id_tarif and Numbers_phone.number=".$_SESSION['number']."";
$result14 = mysql_query($query14);
$row14 = mysql_fetch_array($result14);
echo "<img src='image/sim-current.png' style='position:absolute; left:5px; top:45px;'>
<p class='tarif'>".$row13['name']."</p>
<p style='position:absolute; top: 60px; left:55px;'>В ".$row14['abon_plata']." руб/мес включено: ".$row14['opisanie']."</p><hr style='position:relative; top:110px;'>";

$query15 = "Select id_t, name, abon_plata, st_podkl, opisanie from Tarifs, Numbers_phone where Tarifs.id_t <> Numbers_phone.id_tarif and Numbers_phone.number=".$_SESSION['number']."";
		$result15 = mysql_query($query15);
		
	echo "<h2 style='color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:115px;'>Другие тарифные планы</h2><br><br>";
	echo "<table class='table1'>";
							while ($row15=@mysql_fetch_array($result15))
							{
								$i=$row15['id_t'];
								echo "<tr align='center'><td rowspan=2><img src='image/sim.png'></td><td align=left style='font-size:18px;'>".$row15['name']."</td></tr>
								<tr><td>В ".$row15['abon_plata']." руб/мес включено: ".$row15['opisanie'].". Стоимость подключения: ".$row15['st_podkl']." руб.</td>
								<td>";
								if ($row13['balance']>0) {								
								echo "<input type='submit' name=".$i." value='Подключить' class ='sim'></td>";
								echo "</tr><tr><td colspan=4><hr></td></tr>";}
								else {echo "</tr><tr><td colspan=4><hr></td></tr>";};
								
								if (isset($_POST[$i]))
								{
								$query16 = "UPDATE `SS`.`Numbers_phone` SET `id_tarif` = ".$i." WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
								$result16 = mysql_query($query16);
								$query17 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance -".$row15['st_podkl']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
								$result17 = mysql_query($query17);
								$query18 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Подключение тарифа<br>&#171;".$row15['name']."&#187;',".$row15['st_podkl'].",".$_SESSION['number'].")";
								$result18 = mysql_query($query18);
								echo "<meta http-equiv='refresh' content='0;url=./tarif.php';";
		}
							}
							echo "</table>";
							
							
	
?>

</div>
</form>
</body>
</html>
