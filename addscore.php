 <?php

$highScoreTag = $_GET["highScoreTag"];
$highScoreScore = $_GET["highScoreScore"];

$servername = "*****";
$username = "*****";
$password = "*****";
$dbname = "*****";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO highScore (highScoreTag, highScoreScore) VALUES ('$highScoreTag', $highScoreScore)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
echo "<br><br>";

echo "<html>";
echo "<body>";
echo "<input type='button' onclick=window.location.href='scores.php' value='Scores'>";
echo "</body>";
echo "</html>";

$conn = null;
?>





