<?php
require_once 'Structures/Graph.php';
require_once 'Structures/Graph/Node.php';
 
$nonDirectedGraph = new Structures_Graph(false);
 
$nodes_names = array('a', 'b', 'c' ,'d', 'e');
$nodes = array();
 
foreach($nodes_names as $node) {
    /* Create a new node / vertex */
    $nodes[$node] = new Structures_Graph_Node();
 
    /* Add the node to the Graph structure */
    $nonDirectedGraph ->addNode($nodes[$node]);
}
 
/**
  * Specify connections between different nodes.
  * For example in the following array, 'a-b'
  * specifies that node 'a' is connected to node 'b'.
  * Also refer to the figure above.
  */
 
$vertices = array('a-b', 'b-c', 'b-d', 'd-c', 'c-e', 'e-d');
 
foreach($vertices as $vertex) {
    $data = preg_split("/-/",$vertex);
    $nodes[$data[0]]->connectTo($nodes[$data[1]]);
}

$test1 = array('a','b');
$test2 = array('c','d');
$test3 = array_merge($test1,$test2);
print_r ($test3);
echo $nodes['b']->inDegree(); // returns 3
echo $nodes['b']->outDegree(); // returns 3

require_once 'Structures/Graph/Manipulator/AcyclicTest.php';
 
$t = new Structures_Graph_Manipulator_AcyclicTest();
if($t->isAcyclic($nonDirectedGraph)) {
    echo "cyclic";
}

/* Get a list of all the nodes in our graph */
$array_nodes = $nonDirectedGraph->getNodes();
 
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
echo "  ";
foreach($nodes_names as $name) {
    echo $name . " ";
}
echo "\n";
 
foreach($nodes_names as $row){
    echo $row . " ";
    foreach($nodes_names as $col){
        echo $adj_matrix[$row][$col] . " ";
    }
    echo "\n";
}
?>