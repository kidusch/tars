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


<h1>Trust Aware Recommender Systems (TARS)</h1>
<p>TARS are recommender systems enhanced by trust system to give a credible suggestion or recommendation for a user to optimize his/her experience on a website. In real life, people tend to rely on recommendations from friends or trusted individuals on the domain.  </p>
<p>The basic architecture seems as follows:</p>
<img src="images/tars_architecture.png" alt="TARS Architecture">

</body>
</html>