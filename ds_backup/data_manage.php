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
</header>
<div class="topnav">
  <a class="active" href="#home">射手/助攻榜</a>
  <a href="#news">球队管理</a>
  <a href="#contact">关于联赛</a>
</div>

<main>
  <div id="container">
  <div id="left"><table id="shooter_table">
		<caption>射手榜</caption>
		<thead>
			<tr>
				<th>排名
			    <th>球员
				<th>号码
				<th>球队
				<th>总进球
				<th>普通进球
			  <th>点球
		</thead>
	  <tbody>
		  <?php
		  	include 'connect_db.php';
			$sql="SELECT * FROM players";
			$result = mysqli_query($con,$sql);
		  	$order = 1;
		  while($row = mysqli_fetch_array($result)){
			  echo "<tr>";
				  echo "<td>".$order."</td>";
				  echo "<td>".$row['players']."</td>";
				  echo "<td>".$row['number']."</td>";
				  echo "<td>".$row['club_id']."</td>";
				  echo "<td>".($row['goal']+$row['point'])."</td>";
				  echo "<td>".$row['goal']."</td>";
				  echo "<td>".$row['point']."</td>";
				$order = $order + 1;
		  }
		?>
	  </tbody>
	</table></div>
  <div id="right"><table id="assist_table">
		<caption>助攻榜</caption>
		<thead>
			<tr>
				<th>排名
			    <th>球员
				<th>号码
				<th>球队
				<th>助攻数
		</thead>
	  <tbody>
		  <?php
		  	include 'connect_db.php';
			$sql="SELECT * FROM players";
			$result = mysqli_query($con,$sql);
		  	$order = 1;
		  while($row = mysqli_fetch_array($result)){
			  echo "<tr>";
				  echo "<td>".$order."</td>";
				  echo "<td>".$row['players']."</td>";
				  echo "<td>".$row['number']."</td>";
				  echo "<td>".$row['club_id']."</td>";
				  echo "<td>".$row['assist']."</td>";
				$order = $order + 1;
		  }
		?>
	  </tbody>
	</table></div>
</div>
		
		
  
</main>
	
<footer>
  <p>Posted by: miao</p>
  <p>Contact information: <a href="miao2005xu@163.com">
  miao2005xu@163.com</a>.</p>
</footer>
</body>
</html>