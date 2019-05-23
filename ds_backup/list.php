<meta charset="UTF-8">
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