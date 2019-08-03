<?php 
//Establishing PDO connection
$host = 'localhost';
$dbname = 'clubapp';
$user = 'root';
$pass = 'PASSWORD';
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

//Variables
$club = array();

//Getting Club Info
$stmt = "SELECT * FROM clubapp.pendingclubs where ID = :id";
$prep = $dbh->prepare($stmt);
$prep->bindParam(':id', $_POST['approvalID']);
$prep->execute();
$club = $prep->fetch(PDO::FETCH_ASSOC);

//Deleting the club from the applications page
try
{
    $stmtfinal = "DELETE FROM clubapp.pendingclubs WHERE `clubName` LIKE :clubsname";
    $prepStepSeven = $dbh->prepare($stmtfinal);
    $prepStepSeven->bindParam(":clubsname", $club['clubName']);
    $prepStepSeven->execute();
} catch (PDOException $e)
{
    echo $e->getMessage() . " " . "Line: " . $e->getLine();
}

?>