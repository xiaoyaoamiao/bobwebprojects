<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>

<link href="css/menucss.css" rel="stylesheet" type="text/css">
<link href="css/tablecss.css" rel="stylesheet" type="text/css">
<link href="css/menucss_black.css" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body class="mainbody">
<header class="header" align="center">
  <h1>美世纪珠宝业余联赛</h1>
	<script src="js/jquery.min.js"></script>
    <script>
          $(function(){
              $("#content").load("list.php");
          });
</script>
<script>
function menuclick(item){
	if (item == "list") {
		$("#content").load("list.php");
		document.getElementById("list").className = "active";
		document.getElementById("club-manage").className = "";
		document.getElementById("data-manage").className = "";
		document.getElementById("about").className = "";
	}
	if (item == "club-manage") {
		$("#content").load("player_manage.php");
		document.getElementById("list").className = "";
		document.getElementById("club-manage").className = "active";
		document.getElementById("data-manage").className = "";
		document.getElementById("about").className = "";
	}
	if (item == "data-manage") {
		$("#content").load("data_manage.php");
		document.getElementById("list").className = "";
		document.getElementById("club-manage").className = "";
		document.getElementById("data-manage").className = "active";
		document.getElementById("about").className = "";
	}
	if (item == "about") {
		$("#content").load("");
		document.getElementById("list").className = "";
		document.getElementById("club-manage").className = "";
		document.getElementById("data-manage").className = "";
		document.getElementById("about").className = "active";
	}
}
</script>
	
<script src="club_manage.js"></script>
</header>

<div class="topnav">
  <a id="list" class="active" href="#list" onClick="menuclick('list')">射手/助攻榜</a>
  <a id="club-manage" href="#club-manage" onClick="menuclick('club-manage')">球队管理</a>
  <a id="data-manage" href="#data-manage" onClick="menuclick('data-manage')">数据录入</a>
  <a id="about" href="#contact" onClick="menuclick('about')">关于联赛</a>
</div>

<main>
	<div id="content"></div>
</main>
	
<footer>
  <p>Posted by: miao</p>
  <p>Contact information: <a href="miao2005xu@163.com">
  miao2005xu@163.com</a>.</p>
</footer>
</body>
</html>