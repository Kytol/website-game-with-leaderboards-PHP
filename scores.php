<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Scoreboard
    </title>
       <link rel="stylesheet" type="text/css" href="w3.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico">
  </head>
  <body>

    <div id="header">   <h1>JJA Projects</h1>
    </div>
  <div class="w3-btn-group">
    <button class="w3-btn w3-amber" style="width:50%" onclick="window.location='/project/index.html';">MAIN PAGE</button>
    <button class="w3-btn w3-teal" style="width:50%" onclick="window.location='credits.html';">CREDITS</button>

  </div>
    <div id="main">      <h2>SCOREBOARD</h2>
      <div id="content">

<br>
<div id="keskitys">

<?php
$USER = $_GET["userID"];
$top = 1;
$QWERTY = $_GET["KOKO"];


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Top</th><th>TAG</th><th>Score</th><th>Date</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
	global $top;
 	echo "<td style='width:150px;border:1px solid black;'>" . $top . "</td>";
	$top++;
}

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "ROOT";
$password = "lolman";
$dbname = "highscore";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT UCASE(highScoreTag), highScoreScore, DATE_FORMAT(highScoreDate, '%d/%m/%Y') FROM highScore ORDER BY highScoreScore ASC LIMIT 10");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</div>




        <br>
      </div>
      </main>
    </div>
    <div id="footer">
      <p>All rights reserved.
      </p>
      </div>
  </body>
</html>
