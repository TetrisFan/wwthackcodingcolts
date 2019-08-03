<?php 
//Include
include('server.php');
include('club-profile-admin.php');

//Setting Variables
$currentUser = array();
$selectedMember = array();

//Connection Testing
if ($db->connect_error)
{
    die("Connection failed: " . $db->connect_error);
}

//Getting the info for the current user
$queryForUserInfo = "SELECT * FROM clubapp.clubstudents WHERE ClubID = ? AND GoogleStudentID = ?";
$prepEin = $db->prepare($queryForUserInfo);
$prepEin->bind_param("ii", $currentClubID, $_SESSION['studentid']);
$prepEin->execute();
$currentUserRaw = $prepEin->get_result();
while ($row = $currentUserRaw->fetch_assoc())
{
    $currentUser['ID'] = $row['GoogleStudentID'];
    $currentUser['Officer'] = $row['Officer'];
}
$prepEin->close();

//Getting the info for the clicked user
$queryForMemberInfo = "SELECT * FROM clubapp.clubstudents WHERE ClubID = ? AND GoogleStudentID = ?";
$prepZwei = $db->prepare($queryForMemberInfo);
$prepZwei->bind_param("ii", $currentClubID, $_GET['id']);
$prepZwei->execute();
$selectedMemberRaw = $prepZwei->get_result();
while($rowTwo = $selectedMemberRaw->fetch_assoc()) 
{
    $selectedMember['ID'] = $rowTwo['GoogleStudentID'];
    $selectedMember['Officer'] = $rowTwo['Officer'];
}
$prepZwei->close();

//Deleting the User

//If the id is set, the user is an officer, the selected user isn't the current user, and the selected member isn't an officer
if( (isset($_GET['id'])) && ($currentUser['Officer'] == 1) && ($currentUser['ID'] != $_GET['id']) && ($selectedMember['Officer'] != 1) )  
{
    $removeStudentStatement = "DELETE from clubapp.clubstudents WHERE GoogleStudentID = ?" or die(msqli_error($db));
    $prepUno = $db->prepare($removeStudentStatement);
    $prepUno->bind_param("i", $_GET['id']);
    $prepUno->execute();
    echo 'Done.';
    $prepUno->close();
}//If the id is set, the user is a sub-officer, the selected user isn't the current user, and the selected member isn't an offcer nor sub officer
elseif( (isset($_GET['id'])) && ($currentUser['Officer'] == 2) && ($currentUser['ID'] != $_GET['id']) && ($selectedMember['Officer'] != 1) && ($selectedMember['Officer'] != 2))  
{
    $removeStudentStatement = "DELETE from clubapp.clubstudents WHERE GoogleStudentID = ?" or die(msqli_error($db));
    $prepUno = $db->prepare($removeStudentStatement);
    $prepUno->bind_param("i", $_GET['id']);
    $prepUno->execute();
    echo 'Done.';
    $prepUno->close();
}
else
{
    echo 'Something is wrong...';
}

?>