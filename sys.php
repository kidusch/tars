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

//Select query running and displaying using while loop in bootstrapped table
$sql = "SELECT iduser, idtrusted FROM trust LIMIT 100";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    //verti is a variable to find vertices of the table trust in such a way a-b meaning a trusts b
    //iduser is a variable to find all the users who trust
    //idtrusted is a variable to find all the users who are trusted
    //merged is a variable which merges iduser and idtrusted, which then be represented by nodes_names with the unique users
    $start = microtime(true);
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

    $time_elapsed_secs = microtime(true) - $start;
    $trustedBy = $nodes['22']->outDegree();
    // outdegree is the number of nodes ‘b’ is connecting to
    //inDegree is the number of nodes 'b' is connected to
    echo "id user 22 is trusted by ".$trustedBy;
    echo " and it took ".$time_elapsed_secs;

    // and naturally, nodes can report on their arcs
    //gets all the neightbors of a certain node
    $arcs1 = $nodes['22']->getNeighbours();
    $arcs2 = $nodes['23']->getNeighbours();
    for ($i=0;$i<sizeof($arcs1);$i++) {
      print("22 -  " . $arcs1[$i]->getData());
      print("</br>");
    }
    $merged_arcs = array_merge($arcs1,$arcs2);
    $nodes_names_arcs = array_unique($merged_arcs);

    //Method to check if it is cyclic or not
    //The graph is cyclic only to the LIMIT 135
    $t = new Structures_Graph_Manipulator_AcyclicTest();
    if($t->isAcyclic($nonDirectedGraphTest)) {
        echo "<br/> The graph is cyclic<br/>";
    }
    else{
        echo "<br/>Not cyclic";
    }

    /* Get a list of all the nodes in our graph */
    $array_nodes = $nonDirectedGraphTest->getNodes();

    /* This is where will save the adj. matrix */
    $adj_matrix = array();

    /* Reset the matrix to all '0's */
    foreach($nodes_names as $row){
      foreach($nodes_names as $col){
        $adj_matrix[$row][$col] = 0;
      }
    }

    /* Now build the adj. matrix */
    foreach($array_nodes as $nd) {
        $row = $nd->getData();
        $neighbours  = $nd->getNeighbours();

        foreach($neighbours as $neighbour) {
            $col = $neighbour->getData();
            $adj_matrix[$row][$col] = 1;
        }
    }
    /* Print the adj. matrix */
    echo "<table class=\"table table-striped\">";
    echo "<tr><td></td>";
    foreach($nodes_names as $name) {
        echo "<td>" .$name . "</td>";
    }
    echo "</tr>";

    foreach($nodes_names as $row){
        echo "<tr><td>" .$row."</td>" ;
        foreach($nodes_names as $col){
            echo "<td>" .$adj_matrix[$row][$col] . "</td> ";
        }
        echo "</tr>";
    }
    echo "</table>";
    foreach($nodes_names as $col){
        print_r($adj_matrix[22][$col]);
    }
    echo "<br/>";

    //bfs
    function init(&$visited, &$graph)
    {
        foreach ($graph as $key => $vertex) {
            $visited[$key] = 0;
        }
    }

    function breadth_first(&$graph, $start, $visited)
    {
        // create an empty queue
        $q = array();

        // initially enqueue only the starting vertex
        array_push($q, $start);
        $visited[$start] = 1;
        echo $start . "<br/>";

        while (count($q)) {
                $t = array_shift($q);

            foreach ($graph[$t] as $key => $vertex) {
                if (!$visited[$key] && $vertex == 1) {
                    $visited[$key] = 1;
                    array_push($q, $key);
                    echo $key . "\t";
                }
            }
            echo "<br/>";
        }
    }

    $visited = array();
    init($visited, $adj_matrix);
    breadth_first($adj_matrix, 22, $visited);

        /*
        echo "<br/> verti<br/>";
        print_r(array_values($verti));
        echo "<br/>";
        echo "iduser<br/>";
        print_r(array_values($iduser));
        echo "<br/>";
        echo "idtrusted<br/>";
        print_r(array_values($idtrusted));
        echo "<br/>";
        echo "merged<br/>";
        print_r($nodes_names);
        echo "<br/>";*/

    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    ?>
    </body>
    </html>
