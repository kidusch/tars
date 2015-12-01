<html>
<head><title>TARS</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />

<style type="text/css">
    .row{
        margin-left: 0px !important;
        margin-right: 0px !important;
    }
</style>

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

*/


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

$id = $_GET['id'];

$sql = "SELECT t1.iduser,t2.idtrusted,max(t1.trust * t2.trust) as trust FROM (select * from trust where iduser = $id) as t1, trust as t2 WHERE t1.`idtrusted` = t2.`iduser` group by t1.iduser,t2.idtrusted order by trust desc";
$resultTrusted = $conn->query($sql);

$sql = "SELECT t1.iduser,t2.idsimilar,max(t1.similarity * t2.similarity) as similarity FROM (select * from similarity where iduser = $id) as t1, similarity as t2 WHERE t1.`idsimilar` = t2.`iduser` group by t1.iduser,t2.idsimilar order by similarity desc";
$resultSimilarity = $conn->query($sql);

?>
    <br>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <form action="" method="get">
                <input type="text" name="id" class="form-control" placeholder="specify the user ID">
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="list-group">
            <?php
                while($row = $resultTrusted->fetch_assoc()) {
            ?>

              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">
                    <?php
                        echo $row["idtrusted"];
                    ?>
                </h4>
                <p class="list-group-item-text">Trust Level : <?php echo $row["trust"]; ?></p>
              </a>
            <?php
                }
            ?>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="list-group">
            <?php
                while($row = $resultSimilarity->fetch_assoc()) {
            ?>

              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">
                    ID : <?php
                        echo $row["iduser"];
                    ?>
                </h4>
                <p class="list-group-item-text">Similarity Level : <?php echo $row["similarity"]; ?></p>
              </a>
            <?php
                }
            ?>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="list-group">
            <?php
                while($row = $resultSimilarity->fetch_assoc()) {
            ?>

              <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">
                    ID : <?php
                        echo $row["iduser"];
                    ?>
                </h4>
                <p class="list-group-item-text"><?php echo $row["similarity"]; ?></p>
              </a>
            <?php
                }
            ?>
            </div>
        </div>


    </div>

    </body>
    </html>
