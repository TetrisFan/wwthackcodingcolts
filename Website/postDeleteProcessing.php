<?php 
include('server.php');
include ('server3.php');

echo "This is the php file.";
try
{
    echo $_POST['postID'];
    $stmt = "DELETE FROM clubapp.posts WHERE `id` = :postid";
    $prep = $dbh->prepare($stmt);
    $prep->bindParam(":postid", $_POST['postID']);
    $prep->execute();
    echo "Success!";

} catch (PDOException $e)
{
    echo $e->getMessage() . " Line: " . $e->getLine();
}

?>