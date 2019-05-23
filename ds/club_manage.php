<meta charset="UTF-8">
  <link href="css/player_manage.css" rel="stylesheet" type="text/css">
<div id="club_container">
  <div id="club_div">
	  <caption>俱乐部列表管理</caption>
	  <form name="club_management">
队名：<input type="text" name="club_name" required>
队长：<input type="text" name="captain_name" required>
	 <input type="button" value="Add" onclick="add_club()">
	 </form>
	  <br>
    <?php
include 'connect_db.php';
$club_opt = $_GET["opt"];
$t_type = $_GET["t"];
if ($t_type === "club"){
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
		$sql="update soccer.clubs set club = '".$club_name."', captain = '".$club_captain."', credibility = '".$club_credibility."' where id = ".$opt_id."";
		if (mysqli_query($con,$sql)) {
				echo "Record updated to ".$club_name." successfully";
			} else {
				echo "Error: Maybe same value " . $sql . "<br>" . $conn->error;
			}
	}

}

$sql="SELECT * FROM clubs";
$result = mysqli_query($con,$sql);
echo "<table>
    <tr>
    <th >序列</th>
    <th >球队</th>
    <th >队长</th>
	<th >荣誉</th>
	<th >操作</th>
    </tr>";
$list_number = 1;
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td style='width:15%'  align='center' >".$list_number."</td>";
    echo "<td style='width:25%'  align='center'><input id='club". $row['id'] ."' type='text' class='player_input_list' value='". $row['club'] ."'  disabled=true style='width:80%'></td>";
	echo "<td style='width:20%'  align='center'><input id='captain". $row['id'] ."' type='text' value='". $row['captain'] ."'  disabled=true style='width:80%' class='player_input_list'></td>";
	echo "<td style='width:15%'  align='center'><input id='credibility". $row['id'] ."' type='text' value='". $row['credibility'] ."'  disabled=true   style='width:50%' class='player_input_list'></td>";
    echo "<td style='width:35%'  align='center'>
	<input type='submit' id='edit_club_btn". $row['id'] ."' value='Edit' onclick='edit_club(". $row['id'] .");'   style='width:35%'> 
	<input type='submit' id='delete_club_btn". $row['id'] ."' value='Delete' onclick='delete_club(". $row['id'] .");'   style='width:45%'>";
    echo "</tr>";
    $list_number = $list_number + 1;
}
echo "</table>";
?>
  </div>
</div>