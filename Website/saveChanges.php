<?php 
include ('server3.php');
echo $_POST['headline'];
try
{
    $stmt = "UPDATE `posts` SET `headline`= :headline, `desc`= :descriptions WHERE `id` LIKE :postID";
    $prep = $dbh->prepare($stmt);
    $prep->bindParam(":headline", $_POST['headline']);
    $prep->bindParam(":descriptions", $_POST['description']);
    $prep->bindParam(":postID", $_POST['postID']);
    $prep->execute();
    echo "Success!";

} catch (PDOException $e) 
{
    echo $e->getMessage() . " Line: " . $e->getLine();
}



?>