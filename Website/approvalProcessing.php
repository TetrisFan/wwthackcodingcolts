<?php 
$host = 'localhost';
$dbname = 'clubapp';
$user = 'root';
$pass = 'PASSWORD';
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


//Variables
$club = array();
$student = array();
$tagthefirst = array();
$tagthesecond = array();
//Getting the information about the club that we clicked.
//echo $_POST['approvalID'];
$stmt = "SELECT * FROM clubapp.pendingclubs where ID = :id";
$prep = $dbh->prepare($stmt);
$prep->bindParam(':id', $_POST['approvalID']);
$prep->execute();
$club = $prep->fetch(PDO::FETCH_ASSOC);

 /* while($row = $resultClub->fetch_assoc())
{
    $club['Name'] = $row['clubName'];
    $club['Description'] = $row['clubDescription'];
    $club['ID'] = $row['ID'];
    $club['TagOne'] = $row['tag1'];
    $club['TagTwo'] = $row['tag2'];
    $club['SubmittedUserID'] = $row['userID'];

}
*/

//Getting information about the user who submitted the request
//echo $club['userID'];
try
{
    $stustmt = "SELECT * FROM clubapp.googlelogin WHERE `uid` = :userID";
    $prepNext = $dbh->prepare($stustmt);
    $prepNext->bindParam(':userID', $club['userID']);
    $prepNext->execute() or die(mysqli_error($dbh));
    $student = $prepNext->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo $e->getMessage();
}

//debug
//print_r($club);
//print_r($student);
//Putting the club into the Database
try 
{
    $clustmtone = "INSERT INTO clubapp.club (`ClubName`,`ClubDescription`) VALUES (:clubName, :clubDescription)";
    //print_r($dbh->error_list);
    $prepStep = $dbh->prepare($clustmtone);
    $prepStep->bindParam(":clubName", $club['clubName']);
    $prepStep->bindParam(":clubDescription", $club['clubDescription']);
    $prepStep->execute() or die(mysqli_error($dbh));
} catch(PDOException $e) 
{
    echo $e->getMessage();
}

//Getting the ID of our tags\
//echo $club['tag1'] ;

if (!empty($club['tag1']))
{
    echo "Running the first tag.";
    $tagstmt = "SELECT * FROM clubapp.tag WHERE TagName LIKE :tagsname";
    $prepStepTwo = $dbh->prepare($tagstmt);
    $prepStepTwo->bindParam(":tagsname", $club['tag1']);
    $prepStepTwo->execute() or die(mysqli_error($dbh));
    $tagthefirst = $prepStepTwo->fetch(PDO::FETCH_ASSOC);
    print_r($tagthefirst);
}

echo $club['tag2'];

if(!empty($club['tag2']))
{
    echo "Running the second tag.";
    $tagstmttwo = "SELECT * FROM clubapp.tag WHERE TagName LIKE :tagsnames";
    $prepStepThree = $dbh->prepare($tagstmttwo);
    $prepStepThree->bindParam(":tagsnames", $club['tag2']);
    $prepStepThree->execute() or die(mysqli_error($dbh));
    $tagthesecond = $prepStepThree->fetch(PDO::FETCH_ASSOC);
    print_r($tagthesecond);
}

//Getting the info of the club that we just put into the database
if(isset($tagthefirst['TagID']))
{
    $clustmtwo = "SELECT * FROM clubapp.club WHERE clubName LIKE :clubsname";
    $prepStepNext = $dbh->prepare($clustmtwo);
    $prepStepNext->bindParam(":clubsname", $club['clubName']);
    $prepStepNext->execute() or die(mysqli_error($dbh));
    $newClub = $prepStepNext->fetch(PDO::FETCH_ASSOC);
}

//Putting the club tags inside the Database
//Debug
print_r($newClub);
echo $newClub['ClubID'];
echo $tagthefirst['TagID'];
echo $tagthesecond['TagID'];

try 
{
    if (isset($tagthefirst['TagID']) && isset($newClub['ClubID']))
    {
        $tagstmtthree = "INSERT INTO clubapp.clubtag (`TagID`, `ClubID`) VALUES (:tagsID, :clubsID)";
        $prepStepFour = $dbh->prepare($tagstmtthree);
        $prepStepFour->bindValue(":tagsID", $tagthefirst['TagID'], PDO::PARAM_INT);
        $prepStepFour->bindValue(":clubsID", $newClub['ClubID'], PDO::PARAM_INT);
        $prepStepFour->execute();
    }
    
    if (isset($tagthefirst['TagID']) && isset($newClub['ClubID']))
    {
        $tagstmtfour = "INSERT INTO clubapp.clubtag (`TagID`, `ClubID`) VALUES (:tagsID, :clubsID)";
        $prepStepFive = $dbh->prepare($tagstmtfour);
        $prepStepFive->bindParam(":tagsID", $tagthesecond['TagID']);
        $prepStepFive->bindParam(":clubsID", $newClub['ClubID']);
        $prepStepFive->execute() or die(mysqli_error($dbh));
    }
} catch (PDOException $e)
{
    echo $e->getMessage() . " " . "Line: " . $e->getLine();
}


//Putting the User into the club as an officer
try
{
    $officerVar = 1;
    $stmtwo = "INSERT INTO clubapp.clubstudents(`ClubID`, `Officer`,`GoogleStudentID`) VALUES (:clubsID, :officers, :googlestudentIDs)";
    $prepStepSix = $dbh->prepare($stmtwo);
    $prepStepSix->bindParam(":clubsID", $newClub["ClubID"]);
    $prepStepSix->bindParam(":officers", $officerVar);
    $prepStepSix->bindParam(":googlestudentIDs", $student["uid"]);
    $prepStepSix->execute() or die(mysqli_error($dbh));
} catch (PDOException $e) 
{
    echo $e->getMessage() . " " . "Line: " . $e->getLine();
}

//Deleting the club from the pending application list

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