<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
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


        <form action="transection.php">
            <table border="2" align="center">
       
        <tr style="background-color: pink" align="center">
            <th>
            Transection Details
            </th>
        </tr>
        </table>
        <table border="2" align="center">
            <tr>
        <td>
     <input type="button" value="Back" name="home"ONCLICK="window.location.href='index.php' ""/>
    
   <input type="button" value="View All Transfer" name="home"ONCLICK="window.location.href='viewTransfer.php' ""/></td>
   </tr>
        </table>
        </form>

        <?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>Username</th><th>Total Amount</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
    
     parent::__construct($it, self::LEAVES_ONLY); 
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
    $stmt = $conn->prepare("SELECT user_id, u_name, total_amt FROM user_detail"); 
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
