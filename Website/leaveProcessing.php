<?php 
include('server.php');
include ('server3.php');
echo "This is the php file.";
try
{
    echo $_SESSION['studentid'];
    $stmt = "DELETE FROM clubapp.clubstudents WHERE `GoogleStudentID` = :studid";
    $prep = $dbh->prepare($stmt);
    $prep->bindParam(":studid", $_SESSION['studentid']);
    $prep->execute();
    echo "Success!";

} catch (PDOException $e)
{
    echo $e->getMessage() . " Line: " . $e->getLine();
}

?>