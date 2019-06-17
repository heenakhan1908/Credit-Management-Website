<!DOCTYPE html>
<html>
<body>
        <style>  body {
    background-color: #d0e4fe;
}
u
{
    color: purple;
}
h2 {
    
    text-align: center;
} </style>




<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>Username</th><th>User EmailID</th><th>Initial Credit</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
    
     parent::__construct($it, self::LEAVES_ONLY); 
echo "<td><form action='transfer.php' method='POST'><input type='submit' name='submit-btn' value='View/Transfer Credit' /></form></td></tr>";
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 

}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "transaction";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT user_id, u_name, u_email, total_amt FROM user_detail"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())
 ) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";



?> 


</body>
</html>
