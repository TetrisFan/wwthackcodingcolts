<?php 
include('server.php');
include('server3.php');

try
{
    echo $_GET['id'];
    $stmt = "UPDATE `clubstudents` SET `Officer`= 2 WHERE `GoogleStudentID` = :studid";
    $prep = $dbh->prepare($stmt);
    $prep->bindParam(':studid', $_GET['id']);
    $prep->execute();
    echo "Success.";

} catch (PDOException $e) 
{
    echo $e->getMessage() . " Line: ". $e->getLine();
}



?>