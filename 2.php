<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" />
<title>Раскрывающиеся блоки "div" на JavaScript. Демонстрация.</title>
<style>
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
 width: 474px;
 border: 1px solid #cccccc;
 border-top: none;
 padding: 15px;
 text-align: left;
 background: #eeeeee;
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
<div id="intro">
<p>
<div id="slider">


 <div class="header" id="1-header">Первый блок</div>
 <div class="content" id="1-content">
 <div class="text">
 
 <div>
<a onclick="hidetxt('div1'); return false;" href="#" rel="nofollow">Ссылка 1</a>
<div style="display:none;" id="div1">
Много много много текста 1
</div>
</div>
<div>
<a onclick="hidetxt('div2'); return false;" href="#" rel="nofollow">Ссылка 2</a>
<div style="display:none;" id="div2">
Много много много текста 2
</div>
</div>
<div>
<a onclick="hidetxt('div3'); return false;" href="#" rel="nofollow">Ссылка 3</a>
<div style="display:none;" id="div3">
Много много много текста 3
</div>
</div>
 
 </div>
 </div>
 
 
 
 
 
 <div class="header" id="2-header">Второй блок</div>
 <div class="content" id="2-content">
 <div class="text">
 Содержимое блока.
 </div>
 </div>
 <div class="header" id="3-header">Третий блок</div>
 <div class="content" id="3-content">
 <div class="text">
 Содержимое блока.
 </div>
 </div>
</div>
</p>
</div>
 

</body>
</html>