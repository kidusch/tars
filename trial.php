<html>
<head><title>TARS</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";

//Select query running and displaying using while loop in bootstrapped table
$sql = "SELECT iduser,idtrusted,trust FROM trust";
$result = $conn->query($sql);
echo "<table class=\"table table-striped\"><tr><td>iduser</td><td>idtrusted</td><td>trust</td></tr>";
$i = 0;
     // output data of each row
     while($row = $result->fetch_assoc()) {
        $trust[$i] = array($row["iduser"],$row["idtrusted"]);
         if ($row["iduser"] == 1){
            echo "<tr><td>". $row["iduser"]. " </td><td>". $row["idtrusted"]. "</td><td>" . $row["trust"] . "</td></tr>";
         }
         else{
            echo "<tr><td>Q". $row["iduser"]. " </td><td>". $row["idtrusted"]. "</td><td>" . $row["trust"] . "</td></tr>";
         }
         $i++;
     }
echo "</table>";
echo implode(" ",$trust[2]);
echo "<br>";
echo count($trust);
echo "<br>";
for ($j=0; $j<count($trust); $j++){
    for ($k=0; $k<2; $k++){
        $resultfinal[$j][$k] = $trust[$j][$k];
        echo $trust[$j][$k];
        
    }
    echo "<br>";
}

for ($l=0; $l<count($resultfinal); $l++){
    for ($m=0; $m<2; $m++){
        
    }
    echo "<br>";
}
?>

</body>
</html>