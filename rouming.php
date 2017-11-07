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
	<title>Роуминг - Личный кабинет МегаФон</title>
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
<a href="lk.php">Главная</a><p>&#8592;Роуминг</p>
</div>

<h1 class="personaldata">Роуминг</h1>

<?php
echo "<div id='personaldata1'>";

							
			if (isset($_POST['off']))
{	
echo "<h2 style='color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:-10px;'>Подключено</h2>";	
$query = "UPDATE `SS`.`Numbers_phone` SET `id_rouming` = '0' WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
$result = mysql_query($query);
$query17 = "SELECT name, number FROM Rouming,Numbers_phone where Rouming.id_r=Numbers_phone.id_rouming and Numbers_phone.number=".$_SESSION['number']."";
$result17 = mysql_query($query17);
$row17 = mysql_fetch_array($result17);
$query18 = "Select name, abon_plata, st_podkl, opisanie_r from Rouming, Numbers_phone where Rouming.id_r=Numbers_phone.id_rouming and Numbers_phone.number=".$_SESSION['number']."";
$result18 = mysql_query($query18);
$row18 = mysql_fetch_array($result18);
echo "<img src='image/sim-current.png' style='position:absolute; left:5px; top:45px;'>
<p class='tarif'>".$row17['name']."</p>
<p style='position:absolute; top: 60px; left:55px;'>".$row18['opisanie_r']."</p><hr style='position:relative; top:130px;'>";


$query19 = "Select id_r, name, abon_plata, st_podkl, opisanie_r, geography, balance from Rouming, Numbers_phone where Rouming.id_r <> Numbers_phone.id_rouming and geography='R' and Numbers_phone.number=".$_SESSION['number']."";
		$result19 = mysql_query($query19);
	echo "<h2 style='color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:130px;'>Можете подключить</h2>";
	echo "<h2 style='color: black; font-family: PFDinDisplayPro-Light; position:relative; top:155px; left:25px;'>По России</h2><br><br>";
	echo "<table class='table1'>";
							while ($row19=@mysql_fetch_array($result19))
							{
								$i=$row19['id_r'];
								echo "<tr align='center'><td rowspan=2><img src='image/sim.png'></td><td align=left style='font-size:18px;'>".$row19['name']."</td></tr>
								<tr><td>".$row19['opisanie_r']."<br>Абонентская плата:&nbsp;".$row19['abon_plata']."руб./день."."&nbsp;Стоимость подключения:&nbsp;".$row19['st_podkl']."руб.</td>
								<td>";
								if ($row19['balance']>0) {
								echo "<input type='submit' name=".$i." value='Подключить' class ='sim'></td>";
								echo "</tr><tr><td colspan=4><hr></td></tr>";}
								else {echo "</tr><tr><td colspan=4><hr></td></tr>";};
								
								if (isset($_POST[$i]))
								{
								$query20 = "UPDATE `SS`.`Numbers_phone` SET `id_rouming` = ".$i." WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
								$result20 = mysql_query($query20);
								$query21 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance -".$row19['st_podkl']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
								$result21 = mysql_query($query21);
								$query22 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Подключение роуминга<br>&#171;".$row19['name']."&#187;',".$row19['st_podkl'].",".$_SESSION['number'].")";
								$result22 = mysql_query($query22);
								echo "<meta http-equiv='refresh' content='0;url=./rouming.php';";
		}
							}
							echo "</table>";
				
$query23 = "Select id_r, name, abon_plata, st_podkl, opisanie_r, geography, balance from Rouming, Numbers_phone where Rouming.id_r <> Numbers_phone.id_rouming and geography='W' and Numbers_phone.number=".$_SESSION['number']."";
		$result23 = mysql_query($query23);	
	echo "<h2 style='color: black; font-family: PFDinDisplayPro-Light; position:relative; top:140px; left:25px;'>По миру</h2><br><br><br>";
	echo "<table class='table2'>";
							while ($row23=@mysql_fetch_array($result23))
							{
								$i=$row23['id_r'];
								echo "<tr align='center'><td rowspan=2><img src='image/sim.png'></td><td align=left style='font-size:18px;'>".$row23['name']."</td></tr>
								<tr><td>".$row23['opisanie_r']."<br>Абонентская плата:&nbsp;".$row23['abon_plata']."руб./день."."&nbsp;Стоимость подключения:&nbsp;".$row23['st_podkl']."руб.</td>
								<td>";
								if ($row23['balance']>0) {
								echo "<input type='submit' name=".$i." value='Подключить' class ='sim'></td>";
								echo "</tr><tr><td colspan=4><hr></td></tr>";}
								else {echo "</tr><tr><td colspan=4><hr></td></tr>";};
								
								if (isset($_POST[$i]))
								{
								$query24 = "UPDATE `SS`.`Numbers_phone` SET `id_rouming` = ".$i." WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
								$result24 = mysql_query($query24);
								$query25 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance -".$row23['st_podkl']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
								$result25 = mysql_query($query25);
								$query26 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Подключение роуминга<br>&#171;".$row23['name']."&#187;',".$row23['st_podkl'].",".$_SESSION['number'].")";
								$result26 = mysql_query($query26);
								echo "<meta http-equiv='refresh' content='0;url=./rouming.php';";
		}
							}
							echo "</table>";

}	


else {
$queryif = "select id_rouming from Numbers_phone where number=".$_SESSION['number']."";
$resultif = mysql_query($queryif);
$rowif = mysql_fetch_array($resultif);
if ($rowif['id_rouming']!== '0') {echo "<input type='submit' name='off' value='Отключить' class='sim1'>";};

	
echo "<h2 style='color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:-10px;'>Подключено</h2>";
$query17 = "SELECT name, number FROM Rouming,Numbers_phone where Rouming.id_r=Numbers_phone.id_rouming and Numbers_phone.number=".$_SESSION['number']."";
$result17 = mysql_query($query17);
$row17 = mysql_fetch_array($result17);
$query18 = "Select id_r, name, abon_plata, st_podkl, opisanie_r from Rouming, Numbers_phone where Rouming.id_r=Numbers_phone.id_rouming and Numbers_phone.number=".$_SESSION['number']."";
$result18 = mysql_query($query18);
$row18 = mysql_fetch_array($result18);
echo "<img src='image/sim-current.png' style='position:absolute; left:5px; top:45px;'>
<p class='tarif'>".$row17['name']."</p>
<p style='position:absolute; top: 60px; left:55px;'>".$row18['opisanie_r']."";
if ($rowif['id_rouming']!== '0') {echo "<br>Абонентская плата:&nbsp;".$row18['abon_plata']."руб./день.</p>";};
echo "<hr style='position:relative; top:130px;'>";


$query19 = "Select id_r, name, abon_plata, st_podkl, opisanie_r, geography, balance from Rouming, Numbers_phone where Rouming.id_r <> Numbers_phone.id_rouming and geography='R' and Numbers_phone.number=".$_SESSION['number']."";
		$result19 = mysql_query($query19);
	echo "<h2 style='color: green; font-family: PFDinDisplayPro-Light; position:absolute; top:130px;'>Можете подключить</h2>";
	echo "<h2 style='color: black; font-family: PFDinDisplayPro-Light; position:relative; top:155px; left:25px;'>По России</h2><br><br>";
	echo "<table class='table1'>";
							while ($row19=@mysql_fetch_array($result19))
							{
								$i=$row19['id_r'];
								echo "<tr align='center'><td rowspan=2><img src='image/sim.png'></td><td align=left style='font-size:18px;'>".$row19['name']."</td></tr>
								<tr><td>".$row19['opisanie_r']."<br>Абонентская плата:&nbsp;".$row19['abon_plata']."руб./день."."&nbsp;Стоимость подключения:&nbsp;".$row19['st_podkl']."руб.</td>
								<td>";
								if ($row19['balance']>0) {
								echo "<input type='submit' name=".$i." value='Подключить' class ='sim'></td>";
								echo "</tr><tr><td colspan=4><hr></td></tr>";}
								else {echo "</tr><tr><td colspan=4><hr></td></tr>";};
								
								if (isset($_POST[$i]))
								{
								$query20 = "UPDATE `SS`.`Numbers_phone` SET `id_rouming` = ".$i." WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
								$result20 = mysql_query($query20);
								$query21 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance -".$row19['st_podkl']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
								$result21 = mysql_query($query21);
								$query22 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Подключение роуминга<br>&#171;".$row19['name']."&#187;',".$row19['st_podkl'].",".$_SESSION['number'].")";
								$result22 = mysql_query($query22);
								echo "<meta http-equiv='refresh' content='0;url=./rouming.php';";
		}
							}
							echo "</table>";
				
$query23 = "Select id_r, name, abon_plata, st_podkl, opisanie_r, geography, balance from Rouming, Numbers_phone where Rouming.id_r <> Numbers_phone.id_rouming and geography='W' and Numbers_phone.number=".$_SESSION['number']."";
		$result23 = mysql_query($query23);	
	echo "<h2 style='color: black; font-family: PFDinDisplayPro-Light; position:relative; top:140px; left:25px;'>По миру</h2><br><br><br>";
	echo "<table class='table2'>";
							while ($row23=@mysql_fetch_array($result23))
							{
								$i=$row23['id_r'];
								echo "<tr align='center'><td rowspan=2><img src='image/sim.png'></td><td align=left style='font-size:18px;'>".$row23['name']."</td></tr>
								<tr><td>".$row23['opisanie_r']."<br>Абонентская плата:&nbsp;".$row23['abon_plata']."руб./день."."&nbsp;Стоимость подключения:&nbsp;".$row23['st_podkl']."руб.</td>
								<td>";
								if ($row23['balance']>0) {
								echo "<input type='submit' name=".$i." value='Подключить' class ='sim'></td>";
								echo "</tr><tr><td colspan=4><hr></td></tr>";}
								else {echo "</tr><tr><td colspan=4><hr></td></tr>";};
								
								if (isset($_POST[$i]))
								{
								$query24 = "UPDATE `SS`.`Numbers_phone` SET `id_rouming` = ".$i." WHERE `numbers_phone`.`number` = ".$_SESSION['number']."";
								$result24 = mysql_query($query24);
								$query25 = "UPDATE `SS`.`Numbers_phone` SET `balance` = balance -".$row23['st_podkl']." WHERE Numbers_phone.number=".$_SESSION['number']."" ;
								$result25 = mysql_query($query25);
								$query26 = "INSERT INTO `Operations`(`id_op`, `date`, `type`, `sum`, `number_ph`) VALUES (null, now(),'Подключение роуминга<br>&#171;".$row23['name']."&#187;',".$row23['st_podkl'].",".$_SESSION['number'].")";
								$result26 = mysql_query($query26);
								echo "<meta http-equiv='refresh' content='0;url=./rouming.php';";
		}
							}
							echo "</table>";
														
echo "</div>";
}
	
?>

</form>
</body>
</html>
