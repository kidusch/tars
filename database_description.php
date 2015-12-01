<html>
<head><title>TARS</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.mini.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "red";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

?>

<div class="row">
    <img src="images/tars_logo.png" alt="TARS logo" height=100 class="img-rounded">
</div>
<nav class="navbar navbar-default">
<div class="dropdown">
    <button class="btn btn-default" type="button" id="home" ><a href="index.php"><font color = #eb7026>Home</font></a></button>
    <button class="btn btn-default" type="button" id="data_description" ><a href="database_description.php"><font color = #eb7026>Database Description</font></a></button>
    <button class="btn btn-default" type="button" id="data_description" ><a href="basic_understanding.html"><font color = #eb7026>Basic Understanding</font></a></button>
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><a href="algorithms.php"><font color = #eb7026>Algorithms</font></a>
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation" class="dropdown-header">Dropdown header 1</li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font color = #eb7026>Algorithms 1</font> </a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font color = #eb7026>Algorithms 2</font> </a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font color = #eb7026>Algorithms 3</font> </a></li>
      <li role="presentation" class="divider"></li>
      <li role="presentation" class="dropdown-header">Dropdown header 2</li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
    </ul>
    <button class="btn btn-default" type="button" id="about"><a href="about.php"><font color = #eb7026>About</font></a></button>
</div>
</nav>


<h1>Data Base Description</h1>
<p>The goal of this project is to use a real life database to evaluate and present Trust Aware Recommender Systems (TARS). To do so, the dataset chosen for this projecct is extracted from Epinion website <a href="http://epinion.com/">(www.epnions.com).</a></p>
<p>This website is costomers' opinion site, where uers can review items on the website and it has as database schema as follows:</p>
<img src="images/red_schema.png" alt="Data Base Schema">
<p>The crawled database is downloaded from <a href="http://liris.cnrs.fr/red/">Rich Epinion Dataset (RED)</a></p>
<p>The tables are detailed in such a way:</p>
<ul>
    <li>User: name (pseudo and profile url), location, top rank (may be null) and profile visits count</li>
    <li>Similarity: the similarity between iduser and idsimilar is calculated by Pearson coefficient correlation.</li>
    <li>Trust: Web of Trust (WOT) from one user 'iduser' to another user 'idtrusted'. Only +ve values are presented</li>
    <li>Review: associates a user with an item, it contains the rating, between 1 and 5, the review rating (mean of all review ratings associated with this review) and the review date</li>
    <li>Expertise: users who are experts in a category appear here with the expertise (category lead, top reviewer, advisor) associated with the considered category</li>
    <li>Category: name, parent category, lineage (path in the category tree) and depth (in the category tree)</li>
    <li>Product: name and category of the product</li>
</ul>

</body>
</html>