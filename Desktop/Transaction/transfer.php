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


        <form action="transfer.php">
            <table border="2" align="center">
       
        <tr style="background-color: red" align="center">
            <th>
            Transaction    
            </th>
        </tr>
            </table>
        <table border="2" align="center">
            <tr style="background-color: pink" align="center"><td>
            Enter Your Id:<input type="text" name="id" value="" /></tr>
            <tr style="background-color: pink" align="center"><td>
            Enter Your Patner Id:<input type="text" name="aid" value="" /></tr>
           <tr style="background-color: pink" align="center">
            <td>Enter Your Amount : <input type="text" name="amt" value="" /><br>
           </td> </tr>
        <tr style="background-color: pink" align="center"><td>
            <input type="submit" value="Transfer" name="tnf" />
            <input type="button" value="Back" name="home"ONCLICK="window.location.href='index.php' ""/>
            <input type="button" value="View transaction" name="home"ONCLICK="window.location.href='Transaction.php' ""/>

   </td></tr>
            
        </form>
        <?php
        session_start();
        if(isset($_GET['tnf']))
        {
        $id=$_GET['id'];
        $aid=$_GET['aid'];
        $aamt=$_GET['amt'];
        //mysqli_connect("localhost","root","root","transaction");
            mysqli_connect("localhost","root","root");
            mysqli_select_db("transaction");

            //$x=mysql_query("SELECT ((SELECT intbalans FROM user WHERE id ='$id') + (SELECT COALESCE(SUM(amt),0) FROM  `totaltra` WHERE tratype =  'deposit' AND id ='$id') - ( SELECT COALESCE( SUM( amt ),0) FROM  `totaltra` WHERE tratype =  'withdraw' AND id ='$id' )) AS tbalance");
            $db=mysqli_connect("localhost","root","root","transaction");
            //echo $id;

           $result = mysqli_query($db,("SELECT * FROM user_detail WHERE user_id='$id'"));
        if(!empty(mysqli_num_rows($result))) {
            mysqli_query($db,("INSERT INTO transfer VALUES ('$id', '$aid','$aamt')"));
            
            echo '<td>Success Fully Transfer of amt:';
            echo $aamt;
            

            $balanceto = mysqli_query($db,("SELECT total_amt FROM user_detail WHERE user_id = '$aid'"));
            $res1 = mysqli_fetch_array($balanceto);
            $balancefrom = mysqli_query($db,("SELECT total_amt FROM user_detail WHERE user_id = '$id'"));
            $res2 = mysqli_fetch_array($balancefrom);

            $newmoney1  = ($res1['total_amt'] + $_GET['amt']);
            $newmoney2  = ($res2['total_amt'] - $_GET['amt']);

            $result1    = mysqli_query($db,("UPDATE user_detail SET total_amt ='$newmoney1' WHERE user_id = '$aid'"));
            $result2    = mysqli_query($db,("UPDATE user_detail SET total_amt ='$newmoney2' WHERE user_id = '$id'"));





        } 
        else {
             echo '<td>Account No. Not Valid';

    // do other stuff..
         }
                 mysqli_close($db);

            }
        // put your code here
        ?>
    </body>
</html>
