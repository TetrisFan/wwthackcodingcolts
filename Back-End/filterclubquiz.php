<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "PASSWORD";
$dbName = "clubapp";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
//Check connnection
      if($conn-> connect_error)
      {
            die("Connection failed:". $conn-> connect_error);

      }
//tags vairble
      $Language = 0;
      $STEM = 0;
      $sports = 0;
      $Arts=0;
      $Entertainment=0;
      $Media=0;
      $Awareness=0;
      $Service = 0;
      $Career = 0;
      //answer variables
      $q1 = ''; $q2 = ""; $q3 = ''; $q4 = ''; $q5 = ''; $q6 = ''; $q7 = ''; $q7 = ''; /*$q7 = ''; $q8 = ''; $q9 = ''; $q10= ''; $q11 = ''; $q12 = ''; $q13 = '';  $q14 = ''; $q15 = ''; $q16 = '';*/
      $q1 = isset($_POST['q1'])?$_POST['q1']:"";
      $q2 = isset($_POST['q2'])?$_POST['q2']:"";
      $q3 = isset($_POST['q3'])?$_POST['q3']:"";
      $q4 = isset($_POST['q4'])?$_POST['q4']:"";
      $q5 = isset($_POST['q5'])?$_POST['q5']:"";
      $q6 = isset($_POST['q6'])? $_POST['q6']:"";
      $q7 = isset($_POST['q7'])?$_POST['q7']:"";
      $q8 = isset($_POST['q8'])?$_POST['q8']:"";
      $q9 = isset($_POST['q9'])?$_POST['q9']:"";
      $q10 = isset($_POST['q10'])?$_POST['q10']:"";
      $q11 = isset($_POST['q11'])?$_POST['q11']:"";
      $q12 = isset($_POST['q12'])?$_POST['q12']:"";
      $q13 = isset($_POST['q13'])?$_POST['q13']:"";
      $q14 = isset($_POST['q14'])?$_POST['q14']:"";
      $q15 = isset($_POST['q15'])?$_POST['q15']:"";
      $q16 = isset($_POST['q16'])?$_POST['q16']:"";

//Question score function
     
            if ($q1 == 'y')
            {
                  $Language ++; 
            }
            if ($q2 == 'y')
            {
                  $sports++; 
            }
             if ($q3 == 'y')
            {
                  $STEM++; 
            }
             if ($q4 == 'y')
            {
                  $Language++; 
            }
            if ($q5 == 'y')
            {
                  $Arts ++; 
            }
            if ($q6 == 'y')
            {
                  $sports ++; 
            }
            if ($q7 == 'y')
            {
                  $Entertainment ++; 
            }
            if ($q8 == 'y')
            {
                  $Media ++; 
            }
            if ($q9 == 'y')
            {
                  $STEM ++; 
            }
            if ($q10 == 'y')
            {
                  $Career++; 
            }
            if ($q11 == 'y')
            {
                  $Awareness ++; 
            }
            if ($q12 == 'y')
            {
                  $Service ++; 
            }
            if ($q13 == 'y')
            {
                  $Language ++; 
            }
            if ($q14 == 'y')
            {
                  $Arts ++; 
            }
            if ($q15 == 'y')
            {
                  $Awareness ++; 
            }
            if ($q16 == 'y')
            {
                  $Career ++; 
            }


      $max =max ($STEM,$Language,$sports,$Awareness,$Arts,$Service,$Entertainment);
      session_start();
    // $_SESSION['clubnames'] =  $clubnames = array();
    $clubnames = array();    
function selectclub($tagindex)
      {
            global $conn;
            $sql= "SELECT ClubID FROM clubapp.clubtag  WHERE TagID = $tagindex;";
            $result = mysqli_query($conn, $sql);
            $datas = array();
            if (mysqli_num_rows($result)>0)
            {
                  while ($row = mysqli_fetch_assoc($result))
                  {
                        $datas[] = $row;
                  }
            }
             $clubid = array();
            foreach ($datas as $data)
            {
                  $clubid[] =  $data['ClubID'];
            }
            //print_r ($clubid);                    //test statement

      //Print club name from the club id
           
            foreach($clubid as $loops)
            {
             $clubid = $row['ClubID'];
             $club = "SELECT ClubName FROM clubapp.club WHERE ClubID = '$loops'";
             $result = mysqli_query($conn, $club);
             $datas = array();
             while ($row = mysqli_fetch_assoc($result))
                  {
                        $datas[] = $row;
                  }
             $loopdata = 0;
             
             foreach($datas as $loopdata)
                  {
                         $clubnames [] =  $loopdata['ClubName'];   // output 
                  }
            }
            

            shuffle($clubnames);
            print_r ($clubnames);
             $_SESSION['clubnames'] =  $clubnames;
         //   session_start();
           // $_SESSION['answer']  = $clubname;
      }



if (!$max ==0)                                 //select club from the tag 
{ 
      switch ($max) 
      {
      case $STEM:
        //Select club id from tag id
            $tagindex = 4;
            selectclub($tagindex);
            break;
      case $Language:
            $tagindex = 9; 
            selectclub($tagindex);
            break;
      
      case $Arts:
            $tagindex = 1; 
            selectclub($tagindex);
            break;
      case $Entertainment:
            $tagindex = 2; 
            selectclub($tagindex);
            break;
            case $sports:
            $tagindex = 3; 
            selectclub($tagindex);
            break;
            case $Career:
            $tagindex = 5; 
            selectclub($tagindex);
            break;
            case $Awareness:
            $tagindex = 6; 
            selectclub($tagindex);
            break;
            case $Media:
            $tagindex = 7; 
            selectclub($tagindex);
            break;
            case $Servic:
            $tagindex = 8; 
            selectclub($tagindex);
            break;
            
          }
}
?>