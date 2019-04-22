<?php
include 'connect_db.php';
include 'response.php';
$ticket_opt = $_GET["opt"];
$opt_v = intval($_GET["q"]);
mysqli_select_db($con,"ajax_demo");

// #Update ticket
// if ($ticket_opt === "update"){
//     $opt_id = intval($_GET["id"]);
//     $sql="update unpark_tickets set ticket_number = '".$opt_v."' where id = ".$opt_id."";
//     if ($ticket_add != "0")
//     {
//         if (mysqli_query($con,$sql)) {
//             echo "Record updated to ".$opt_v." successfully";
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
//     mysqli_close($con);
// }

include 'connect_db.php';
$sql="SELECT * FROM unpark_tickets";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($result)) {
     $rows[] = $row;
    }
mysqli_close($con);
return Response::api_response(200, 'Success', $rows);

?>