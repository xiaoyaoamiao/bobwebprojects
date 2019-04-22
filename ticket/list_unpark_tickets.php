<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
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
$ticket_add = intval($_GET["q"]);
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM unpark_tickets";
$result = mysqli_query($con,$sql);

echo "<table>
    <tr>
    <th>Ticket ID</th>
    <th>Ticket Number</th>
    </tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><input type='text' name='id' value= " .$row['id']."></td>";
    echo "<td><input type='text' name='ticket_no' value=". $row['ticket_number'] .">
          <input type='submit' name='edit_unpark_btn' value='Edit'>
          <input type='submit' name='delete_unpark_btn' value='Delete'></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>