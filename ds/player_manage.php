<meta charset="UTF-8">
  <link href="css/player_manage.css" rel="stylesheet" type="text/css">
<div id="player_container">
  <div id="player_div">
	  <caption>球员列表管理</caption>
	  <form name="player_management">
球员：<input type="text" name="player_name" required>
球队：<select name="clubs" required>
	 <option value="volvo">Volvo</option>
	 </select>
号码：<input type="text" name="player_number" required>
	 <input type="button" value="Add" onclick="add_club()">
	 </form>
	  <br>
    <?php
include 'connect_db.php';
$club_opt = $_GET["opt"];
$t_type = $_GET["t"];
if ($t_type === "player"){
	if ($club_opt === "add"){
		$club_name = $_GET["club_name"];
		$captain_name = $_GET["captain_name"];
		$sql="insert into clubs(club,captain) values ('".$club_name."','".$captain_name."')";
		if (mysqli_query($con,$sql)) {
			echo "New record  created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	#Delete ticket from DB
	if ($club_opt === "delete"){
		$club_id = $_GET['club_id'];
		$sql="DELETE FROM `soccer`.`clubs` WHERE (`id` = '".$club_id."')";
		if (mysqli_query($con,$sql)) {
			echo  "Record *".$club_id."* deleted successfully";
		} else {
			echo "Error: " . $conn->error;
		}
	}
	#Update club
	if ($club_opt === "update"){
		$opt_id = intval($_GET["id"]);
		$club_name = $_GET["club_name"];
		$club_captain = $_GET["captain_name"];
		$club_credibility = intval($_GET["credibility"]);
		$sql="update soccer.clubs set club = '".$club_name."' and captain = '".$club_captain."' and credibility = '".$club_credibility."' where id = ".$opt_id."";
		if (mysqli_query($con,$sql)) {
				echo "Record updated to ".$club_name." successfully";
			} else {
				echo "Error: Maybe same value " . $sql . "<br>" . $conn->error;
			}
	}
}

$sql="SELECT * FROM players";
$result = mysqli_query($con,$sql);
echo "<table>
    <tr>
    <th>序列</th>
    <th>球队</th>
    <th>球员</th>
	<th>号码</th>
	<th>进球数</th>
	<th>普通进球</th>
	<th>点球</th>
	<th>助攻</th>
	<th>黄牌</th>
	<th>红牌</th>
	<th>操作</th>
    </tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td style='width:6%'  align='center'>".$row['id']."</td>";
    echo "<td  align='center'><input class='player_input_list' id='club". $row['id'] ."' type='text' value='". $row['club_id'] ."'  disabled=true></td>";
	echo "<td  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['players'] ."'  disabled=true style='width:80%'></td>";
	echo "<td style='width:6%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['number'] ."'  disabled=true style='width:80%'></td>";
	echo "<td  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". ($row['goal'] +$row['point'] )."'  disabled=true style='width:30%'></td>";
	echo "<td style='width:10%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['goal'] ."'  disabled=true style='width:30%'></td>";
	echo "<td style='width:8%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['point'] ."'  disabled=true style='width:30%'></td>";
	echo "<td style='width:8%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['assist'] ."'  disabled=true style='width:30%'></td>";
	echo "<td style='width:8%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['yellow'] ."'  disabled=true style='width:30%'></td>";
	echo "<td style='width:8%'  align='center'><input class='player_input_list' id='captain". $row['id'] ."' type='text' value='". $row['red'] ."'  disabled=true style='width:30%'></td>";
    echo "<td style='width:15%'  align='center'><input type='submit' id='delete_club_btn". $row['id'] ."' value='Delete' onclick='delete_club(". $row['id'] .");'>
	<input type='submit' id='edit_club_btn". $row['id'] ."' value='Edit' onclick='edit_club(". $row['id'] .", ". $row['id'] .");' >";
    echo "</tr>";
}
echo "</table>";
?>
	  </div>
</div>