<html>
<head><title>TARS</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
<body>
<?php
/*
- First connects to the database 'red'
- Send query SELECT iduser, idtrusted FROM trust LIMIT 10
- Creates a graph from the query result
- Checks if it is cyclic or not
- From the graph, build an adjacent matrix and display it on table
- From the adjacent matrix, find Breadth first search
- From the adjacent matrix, find Depth first search (not done), for plus d'info: http://www.stoimen.com/blog/2012/09/17/computer-algorithms-graph-depth-first-search/
- Gets neighbors of a certain node
*/
require_once 'Structures/Graph.php';
require_once 'Structures/Graph/Node.php';
require_once 'Structures/Graph/Manipulator/AcyclicTest.php';

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

$start = microtime(true);

for ($target=1; $target<10; $target++){
//Select query running and displaying using while loop in bootstrapped table
$sql = "SELECT iduser, idtrusted FROM trust WHERE iduser = $target";
$result = $conn->query($sql);
$verti = array();
$iduser = array();
$idtrusted = array();
while($row = $result->fetch_assoc()) {
    $verti[] = $row["iduser"].'-'.$row["idtrusted"];
    $iduser[] = $row["iduser"];
    $idtrusted[] = $row["idtrusted"];
}
$merged = array_merge($iduser,$idtrusted);
$nodes_names = array_unique($merged);
$nonDirectedGraphTest = new Structures_Graph(true);

foreach($nodes_names as $node) {
/* Create a new node / vertex */
$nodes[$node] = new Structures_Graph_Node();

/* Add the node to the Graph structure */
$nonDirectedGraphTest ->addNode($nodes[$node]);
}

foreach($verti as $vertex) {
$data = preg_split("/-/",$vertex);
$nodes[$data[0]]->connectTo($nodes[$data[1]]);
}

//sets the value of each node to the corresponding value, for example $nodes['a']->setData("a") so that we could know the neighbor
foreach($nodes_names as $n){
    $nodes[$n]->setData($n);
}
$trustedBy = $nodes[$target]->outDegree();
// outdegree is the number of nodes ‘b’ is connecting to
//inDegree is the number of nodes 'b' is connected to
echo "id user ".$target." trusts ".$trustedBy." users</br>";
$arcs1 = $nodes[$target]->getNeighbours();
for ($i=0;$i<sizeof($arcs1);$i++) {
  print($target." - " . $arcs1[$i]->getData());
  print("</br>");
}

}
$time_elapsed_secs = microtime(true) - $start;
echo "time elapsed in seconds: ".$time_elapsed_secs."</br>";
?>
</body>
</html>
