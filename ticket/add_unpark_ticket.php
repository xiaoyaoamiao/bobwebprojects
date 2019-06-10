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
include 'response.php';
$ticket_opt = $_GET["opt"];
$opt_v = $_GET["q"];
$opt_type = $_GET["t"];
#Insert new ticket to DB
if ($ticket_opt === "add"){
    $sql="insert into unpark_tickets(ticket_number,ticket_type) values ('".$opt_v."','".$opt_type."')";
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
    $status = $_GET["status"];
    $sql="update unpark_tickets set ticket_number = '".$opt_v."',ticket_type = '".$status."'  where id = ".$opt_id."";
    if ($ticket_add != "0")
    {
        if (mysqli_query($con,$sql)) {
            echo "Record updated to ".$opt_v." successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
#Edit ticket description
if ($ticket_opt === "editdes"){
    $opt_id = intval($_GET["ticketid"]);
    $des = $_GET["des"];
    $sql="update unpark_tickets set des = '".$des."'  where id = ".$opt_id."";
    if ($ticket_add != "0")
    {
        if (!mysqli_query($con,$sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

#change ticket type
if ($ticket_opt === "changetype"){
    $opt_id = intval($_GET["id"]);
    $select_value = $_GET["select_value"];
    $sql="update unpark_tickets set ticket_type = '".$select_value."'  where id = ".$opt_id."";
    if ($ticket_add != "0")
    {
        if (!mysqli_query($con,$sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

#Entry ticket
if ($ticket_opt === "entry"){
    $opt_ticketid = $_GET["ticketid"];
    Response::response_entry_ticket(200, $opt_ticketid);

}

$sql="SELECT * FROM unpark_tickets";
$result = mysqli_query($con,$sql);
echo "<table style='width:850px'>
    <tr>
    <th align='center'> ID (".mysqli_num_rows($result).")</th>
    <th align='center'>Ticket Number</th>
    <th align='center'>InPark Status</th>
    <th align='center'>Entry Park</th>
    <th align='center' style='width:200px'>Description</th>
    <th align='center' style='width:50px'>Remove</th>
    </tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td style='width:80px'>".$row['id']."</td>";
    echo "<td style='width:300px'>
          <select id='type". $row['id'] ."' onchange='change_type(". $row['id'] .")'>
          <option value='". strtolower($row['ticket_type']) ."' selected>". strtoupper($row['ticket_type']) ."</option>
             <option value='a'>A</option>
             <option value='b'>B</option>
             <option value='c'>C</option>
             <option value='d'>D</option>
             <option value='e'>E</option>
             <option value='f'>F</option>
             <option value='g'>G</option>
          </select>
          <input id='input_unpark_text". $row['id'] ."' style='width:80%;border:0px' type='text' value='". $row['ticket_number'] ."' onfocusin='edit_text_in(\"". $row['id'] ."\")' onfocusout='edit_text_out(\"". $row['id'] ."\")'>
          <input type='submit' id='edit_unpark_btn". $row['id'] ."' value='Edit' onclick='edit_ticket(". $row['id'] .");' hidden=true>
          </td>";
    $status = Response::response_ticket_status(200, $row['ticket_number']);
    if ($status === "false")
    {
        echo "<td align='center'>false</td>";
        echo "<td align='center'><input type='submit' id='entry_btn' value='Entry' onclick='entry_ticket(\"". $row['ticket_number'] ."\");'></td>";
    }else{
        echo "<td align='center'>true</td>";
        echo "<td align='center'></td>";
    }
    echo "<td align='center'><input id='textfield". $row['id'] ."' style='width:100%; border:0px;' length=30 type='textfield' onfocusin='edit_textfield_in(\"textfield". $row['id'] ."\")' onfocusout='edit_textfield_out(\"textfield". $row['id'] ."\",\"". $row['id'] ."\")' value=". $row['des'] ."></td>";
    echo "<td align='center'><input type='submit' id='delete_unpark_btn". $row['id'] ."' value='Delete' onclick='delete_ticket(". $row['id'] .");'></td>";
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>