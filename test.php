<html>
<head><title>TARS</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "red";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";

//Select query running and displaying using while loop in bootstrapped table
$sql = "SELECT iduser, idtrusted FROM trust LIMIT 20";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
     $vert = array();
     echo "<table class=\"table table-striped\"><tr><td>iduser</td><td>location</td></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
        $vert[] = $row["iduser"].'-'.$row["idtrusted"];
         echo "<tr><td>". $row["iduser"]. " </td><td>". $row["idtrusted"]. "</td></tr>";
     }
     echo "</table>";
     print_r(array_values($vert));
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

</body>
</html>