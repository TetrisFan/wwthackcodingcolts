<?php
include('server.php'); 
echo '
<div class="d-flex flex-row justify-content-center">
    <button href = "#" type="submit" class="btn btn-info d-flex flex-row justify-content-center mt-3" id="refresh" role="button">Refresh</button>
</div>
<div style="position:absolute; top: 15px; left: 46%; font-size: 30px; font-weight: 500; ">Club Stream</div>';
//echo $_SESSION['admin'];
if (!session_id()) session_start();
$id = $_SESSION['studentid'];
$counter = 0;
//personalized club stream
$resultsClub = mysqli_query($db, "SELECT ClubID FROM clubapp.clubstudents WHERE GoogleStudentID = $id;");
if ($resultsClub->num_rows === 0)
{
 $resultsOfPosts = mysqli_query($db, "SELECT * FROM posts ORDER BY time DESC;") or die(mysqli_error($db));
}
else
{
while($rowClub=mysqli_fetch_array($resultsClub))
      {
        $club[] = $rowClub['ClubID'];
      }
      $ids = join(",", $club);
//Get the posts
$resultsOfPosts = mysqli_query($db, "SELECT * FROM posts WHERE clubid IN ($ids) ORDER BY time DESC;") or die(mysqli_error($db));
}
$post = array();
while(($row = mysqli_fetch_assoc($resultsOfPosts)))
{
    $clubName = "";
    $post['Description'] = $row['desc'];
    $post['Headline'] = $row['headline'];
    $post['ClubID'] = $row['clubid'];
    $post['Time'] = $row['time'];
    $post['ID'] = $row['id'];
    $Headline = $post['Headline'];
    $Description = $post['Description'];
    $Time = $post['Time'];
    $TimeDay = date("m/d/y", strtotime($Time));
    $TimeTime = date("h:i a", strtotime($Time));

    $resultsForClubs = mysqli_query($db, "SELECT * FROM club WHERE ClubID = '".$post["ClubID"]."'") or die(mysqli_error($db));
    while(($clubrow = mysqli_fetch_assoc($resultsForClubs)))
    {
        $club['Name'] = $clubrow['ClubName'];
        $clubName = $club['Name'];
    }

    $FrontEnd = ('

    <div data-toggle="modal" data-target="#myModal%s" class="headline-container my-3" id="%s">
      <div class="headline">
        <h1>%s</h1>
        <p class="post-club-name">%s on %s at %s</p>
      </div>
      <div class="headline-text">%s</div>
    </div>
    <div> <!-- modal 1 -->
    <div class="modal fade" id="myModal%s" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header d-flex flex-column align-items-center">
            <button type="button" class="close" data-dismiss="modal" id="myBtn">&times;</button>
            <h1>%s</h1>
            <p class="post-club-name mb-0 mt-1">Posted by %s</p>
          </div>
          <div class="modal-body">
            <p>%s</p>
          </div>
          <div class="d-flex flex-row justify-content-center">
                <button href = "#" type="submit" class="btn btn-primary d-flex flex-row justify-content-center ml-2 mb-3" id="post_edit" role="button" style="background-color:#111753" data-toggle="collapse" data-target="#editPost%s">Edit Post</button>
                <button href = "#" type="submit" class="btn btn-primary d-flex flex-row justify-content-center ml-2 mr-2 mb-3" id="post_delete" role="button">Delete Post</button>
          </div>
          <div class="collapse w-100 mt-3" id="editPost%s">
              <form class = "form-signin" method="post" action="#">
                <div class="form-group">
                  <textarea class="form-control rounded-0 mb-3  " rows="1" name="clubpostheadline" placeholder="Edit this post headline." id="edit-post-headline-textarea%s" style="width: 100%%;">%s</textarea>
                  <textarea class="form-control rounded-0" rows="10" name="clubpostdesc" placeholder="Edit this podst description." id="edit-post-desc-textarea%s" style="width: 100%%">%s</textarea>
                </div>
                <button type="submit" role="button" name="edit_desc" class="btn btn-primary mt-3 mb-2" style="background-color: #009933" id="saveChanges">Save changes</button>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div> <!-- modal -->
<script>
// Get the modal
var modal = document.getElementById("myModal%s");
  // Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
$(document).on("click", modal, function() {
  modal.style.display = "flex";
})

// When the user clicks on <span> (x), close the modal
$(document).on("click", "span", function() {
  modal.style.display = "none";
})

// When the user clicks anywhere outside of the modal, close it
$(document).on("click", "window", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
})

$(document).on("click", "#saveChanges", function() {
    var headline = document.getElementById("edit-post-headline-textarea%s").value;
    var description = document.getElementById("edit-post-desc-textarea%s").value;
    alert("We got the click.");
    $.ajax({
      type: "POST",
      url : "saveChanges.php",
      data: {headline : headline, description : description, postID : postID},
      success : function(result) {
        alert(result);
      }
    })
  })
</script>
 ');

 echo sprintf($FrontEnd, $counter, $post['ID'],$post['Headline'],$clubName , $TimeDay, $TimeTime, $Description, $counter, $Headline, $clubName, $Description, $counter, $counter, $counter, $Headline, $counter, $Description, $counter, $counter, $counter);
 $counter++;
}

  ?>
