<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 500px;
    border-collapse: collapse;
}
table, td, th {
    border: 1px solid black;
    padding: 5px;
}
th {text-align: left;}
</style>
</head>
<body>
<?php
include 'connect_db.php';
$ticket_opt = $_GET["opt"];
$opt_v = $_GET["q"];
#Insert new ticket to DB
if ($ticket_opt === "add"){
    $sql="insert into unpark_tickets(ticket_number) values ('".$opt_v."')";
    if ($opt_v != "0")
    {
        if (mysqli_query($con,$sql)) {
            echo "New record *".$opt_v."* created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
#Delete ticket from DB
if ($ticket_opt === "delete"){
    $sql="DELETE FROM `park_ticket`.`unpark_tickets` WHERE (`id` = '".$opt_v."')";
    if (mysqli_query($con,$sql)) {
        echo  "Record *".$opt_v."* deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
#Update ticket
if ($ticket_opt === "update"){
    $opt_id = intval($_GET["id"]);
    $sql="update unpark_tickets set ticket_number = '".$opt_v."' where id = ".$opt_id."";
    if ($ticket_add != "0")
    {
        if (mysqli_query($con,$sql)) {
            echo "Record updated to ".$opt_v." successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

include 'connect_db.php';
$sql="SELECT * FROM unpark_tickets";
$result = mysqli_query($con,$sql);
echo "<table>
    <tr>
    <th>Ticket ID (".mysqli_num_rows($result).")</th>
    <th>Ticket Number</th>
    <th>InPark Status</th>
    </tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td><input id='input_unpark_text". $row['id'] ."' type='text' value='". $row['ticket_number'] ."'  disabled=true>
          <input type='submit' id='edit_unpark_btn". $row['ticket_number'] ."' value='Edit' onclick='edit_ticket(". $row['ticket_number'] .", ". $row['id'] .");' style='height:60px;width:60px;display:inline-block;'>
          <input type='submit' id='delete_unpark_btn". $row['ticket_number'] ."' value='Delete' onclick='delete_ticket(". $row['id'] .");'></td>";
    if ($row['inpark_or_not'] === "0")
    {
        echo "<td align='center'>False</td>";
    }else{
        echo "<td align='center'>True</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>