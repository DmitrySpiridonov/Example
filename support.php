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
	
	
		<style>
#intro {
	position:absolute;
	top:220px;
	left: 430px;
}
#slider {
 width: 508px;
 color: #66666;
 font-family: Georgia;
 font-size: 20px;
 }
.header {
 width: 488px;
 border: 1px solid #cccccc;
 padding: 8px;
 margin-top: 5px;
 cursor: pointer;
 text-align: center;
 }
.header:hover {
 color: #666666;
 }
.content {
 overflow: hidden;
 }
.text {
 height:160px;
 width: 474px;
 border: 1px solid #cccccc;
 border-top: none;
 padding: 15px;
 text-align: left;
 background: #eeeeee;
 font-size: 16px;
 }
 
 .text p{
 font-style:italic;
 font-size: 14px;
 }
</style>
<script type="text/javascript">
var array = new Array();
var speed = 10;
var timer = 10;
 
// Loop through all the divs in the slider parent div //
// Calculate seach content divs height and set it to a variable //
function slider(target,showfirst) {
 var slider = document.getElementById(target);
 var divs = slider.getElementsByTagName('div');
 var divslength = divs.length;
 for(i = 0; i < divslength; i++) {
 var div = divs[i];
 var divid = div.id;
 if(divid.indexOf("header") != -1) {
 div.onclick = new Function("processClick(this)");
 } else if(divid.indexOf("content") != -1) {
 var section = divid.replace('-content','');
 array.push(section);
 div.maxh = div.offsetHeight;
 if(showfirst == 1 && i == 1) {
 div.style.display = 'block';
 } else {
 div.style.display = 'none';
 }
 }
 }
}
 
// Process the click - expand the selected content and collapse the others //
function processClick(div) {
 var catlength = array.length;
 for(i = 0; i < catlength; i++) {
 var section = array[i];
 var head = document.getElementById(section + '-header');
 var cont = section + '-content';
 var contdiv = document.getElementById(cont);
 clearInterval(contdiv.timer);
 if(head == div && contdiv.style.display == 'none') {
 contdiv.style.height = '0px';
 contdiv.style.display = 'block';
 initSlide(cont,1);
 } else if(contdiv.style.display == 'block') {
 initSlide(cont,-1);
 }
 }
}
 
// Setup the variables and call the slide function //
function initSlide(id,dir) {
 var cont = document.getElementById(id);
 var maxh = cont.maxh;
 cont.direction = dir;
 cont.timer = setInterval("slide('" + id + "')", timer);
}
 
// Collapse or expand the div by incrementally changing the divs height and opacity //
function slide(id) {
 var cont = document.getElementById(id);
 var maxh = cont.maxh;
 var currheight = cont.offsetHeight;
 var dist;
 if(cont.direction == 1) {
 dist = (Math.round((maxh - currheight) / speed));
 } else {
 dist = (Math.round(currheight / speed));
 }
 if(dist <= 1) {
 dist = 1;
 }
 cont.style.height = currheight + (dist * cont.direction) + 'px';
 cont.style.opacity = currheight / cont.maxh;
 cont.style.filter = 'alpha(opacity=' + (currheight * 100 / cont.maxh) + ')';
 if(currheight < 2 && cont.direction != 1) {
 cont.style.display = 'none';
 clearInterval(cont.timer);
 } else if(currheight > (maxh - 2) && cont.direction == 1) {
 clearInterval(cont.timer);
 }
}
</script>
	
	<script>
var show;
function hidetxt(type){
 param=document.getElementById(type);
 if(param.style.display == "none") {
 if(show) show.style.display = "none";
 param.style.display = "block";
 show = param;
 }else param.style.display = "none"
}
</script>
	
	</head>

	<body onload="slider('slider',0)">
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

<td width="120">
<div id="pushed1">Частые вопросы</div>
</td>

<td width="120"><a href="support1.php">
<div id="unpushed1">Консультации по телефону</div></a>
</a></td>


</td>
</tr>
</table>
</div>


<div id="intro">
<p>
<div id="slider">


 <div class="header" id="1-header">Управление номером, SIM-картой</div>
 <div class="content" id="1-content">
 <div class="text">

  <div>
<a onclick="hidetxt('div1'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как узнать свой номер?</a>
<div style="display:none;" id="div1">
<p>Узнать свой номер можно с помощью короткой команды *205# клавиша «Вызов» (беспл.).</p>
</div>
</div>
<div>
<a onclick="hidetxt('div2'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как переоформить номер на другого человека?</a>
<div style="display:none;" id="div2">
<p>Владелец номера и человек, на которого будет переоформлен договор (представитель физического лица), должны обратиться с документами в любой салон связи МегаФон.</p>
</div>
</div>
<div>
<a onclick="hidetxt('div3'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как изменить свой номер?</a>
<div style="display:none;" id="div3">
<p>Чтобы сменить номер, обратитесь в салон связи «МегаФон» с документом, удостоверяющим личность (чтобы узнать адрес ближайшего салона, наберите команду *123#).</p>
</div>
</div>
 
 </div>
 </div>
 
 
 
 <div class="header" id="2-header">Расходы, платежи</div>
 <div class="content" id="2-content">
 <div class="text">

   <div>
<a onclick="hidetxt('div4'); return false;" href="#" rel="nofollow">&#8226;&ensp;Списываются ли у меня деньги за «Мобильные подписки»?</a>
<div style="display:none;" id="div4">
<p>Информацию о наличии подписок на вашем номере вы можете узнать с помощью команды *505# (беспл).</p>
</div>
</div>
<div>
<a onclick="hidetxt('div5'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как узнать стоимость отправки SMS на короткий номер?</a>
<div style="display:none;" id="div5">
<p>Наберите бесплатную команду *107* [короткий номер] #.</p>
</div>
</div>
<div>
<a onclick="hidetxt('div6'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как быть на связи, если нет возможности пополнить баланс?</a>
<div style="display:none;" id="div6">
<p>Достаточно воспользоваться любой из услуг: «Обещанный платеж», «Я звонил», «Звонок за счет друга»; «Позвони мне».</p>
</div>
</div>
 
 
 </div>
 </div>
 
 
 
 <div class="header" id="3-header">Тариф</div>
 <div class="content" id="3-content">
 <div class="text">

    <div>
<a onclick="hidetxt('div7'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как узнать, какой у меня тариф?</a>
<div style="display:none;" id="div7">
<p>Информацию о текущем тарифе вы можете посмотреть в личном кабинете в разделе «Тариф»</p>
</div>
</div>
<div>
<a onclick="hidetxt('div8'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как изменить тариф?</a>
<div style="display:none;" id="div8">
<p>Для того, чтобы изменить тариф вы можете воспользоваться услугой смены тарифа в личном кабинете или же обратиться в любой из ближайших салонов «МегаФон»</p>
</div>
</div>
<div>
<a onclick="hidetxt('div9'); return false;" href="#" rel="nofollow">&#8226;&ensp;Где получить информацию о других тарифах?</a>
<div style="display:none;" id="div9">
<p>Подробную информацию о существующих тарифных планах вы можете увидеть в личном кабинете в разделе «Тариф»</p>
</div>
</div>
 
 
 </div>
 </div>
 
 
 
  <div class="header" id="4-header">Опции, пакеты, услуги</div>
 <div class="content" id="4-content">
 <div class="text">

     <div>
<a onclick="hidetxt('div10'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как мне подобрать услугу?</a>
<div style="display:none;" id="div10">
<p>Чтобы подобрать нужную вам услугу перейдите в Личный кабинет и откройте раздел «Услуги»</p>
</div>
</div>
<div>
<a onclick="hidetxt('div11'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как подключить/отключить опции?</a>
<div style="display:none;" id="div11">
<p>Чтобы подключить/отключить услугу перейдите в Личный кабинет и откройте раздел «Услуги» или же наберите короткую команду *105# и выберите раздел «Услуги»</p>
</div>
</div>
 
 </div>
 </div>
 
 
 
  <div class="header" id="5-header">Роуминг</div>
 <div class="content" id="5-content">
 <div class="text">

     <div>
<a onclick="hidetxt('div12'); return false;" href="#" rel="nofollow">&#8226;&ensp;Нужно ли подключать роуминг при поездках по России?</a>
<div style="display:none;" id="div12">
<p>Нет. В поездках по России подключение роуминга не требуется. Услуга автоматически включена в основной пакет.</p>
</div>
</div>
<div>
<a onclick="hidetxt('div13'); return false;" href="#" rel="nofollow">&#8226;&ensp;Как связаться с абонентской службой «МегаФон» из роуминга?</a>
<div style="display:none;" id="div13">
<p>При нахождении в России или любой другой точке мира для связи с абонентской службой звоните по номеру 0500. Звонок бесплатный.</p>
</div>
</div>
<div>
<a onclick="hidetxt('div14'); return false;" href="#" rel="nofollow">&#8226;&ensp;Какова стоимость звонков в роуминге по России?</a>
<div style="display:none;" id="div14">
<p>Стоимость предоставления услуг связи в роуминге зависит от условий выбранного тарифа. Описание Вашего тарифа, а также стоимость услуг на тарифе можно уточнить на сайте в разделе «Тарифы».</p>
</div>
</div>
 
 
 </div>
 </div>
</div>
</p>
</div>
<hr width=100%; style="position:absolute; top:650px;">
</form>
	</body>
</html>
