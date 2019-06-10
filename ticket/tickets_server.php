<?php
include 'connect_db.php';
include 'response.php';
$ticket_opt = $_GET["opt"];
$opt_v = intval($_GET["q"]);
$opt_t = $_GET["type"];
mysqli_select_db($con,"ajax_demo");
$sql = "";
if  ($opt_t == ""){
	$sql="SELECT * FROM unpark_tickets";
}
else{
	$sql="SELECT * FROM unpark_tickets where ticket_type='".$opt_t."'";
}
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($result)) {
     $rows[] = $row;
    }
mysqli_close($con);
return Response::api_response(200, 'Success', $rows);

?>