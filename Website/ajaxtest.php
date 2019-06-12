<!doctype html>
<html lang="en">

<head>

<title>Testing some Ajax Functionality</title>

  <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



  <!-- Custom styles for this template -->

  <link rel="stylesheet" href="styles.css">

</head>


<body>

<div>
    <button class="btn btn-primary mb-3 mt-2" type="button" data-toggle="collapse" data-target="#editDesc" aria-expanded="false" aria-controls="editDesc" name="editDesc" onClick="getCurrentDesc()">
        Edit club description
    </button>
</div>

<div class="collapse w-100 mt-3" id="editDesc">
    <form class = "form-signin" method="post" action="ajaxtest.php">
        <div class="form-group">
            <textarea class="form-control rounded-0" rows="10" name="clubdesc" placeholder="Edit your club description." id="edit-desc-textarea"></textarea>
        </div>
        <button type="submit" role="button" name="edit_desc" class="btn btn-primary mt-3 mb-2">save changes</button>
    </form>
</div>

<script>
    
    function getCurrentDesc() {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById('edit-desc-textarea').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET","getDescription.php", true);
        xhttp.send();
    }



</script>



</body>